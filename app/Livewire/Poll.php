<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\PollItem;
use App\Models\PollResponse;
use Illuminate\Http\Request;
use App\Models\Poll as PollModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;

class Poll extends Component
{
    public $data = [];

    /**
     * Submits the poll response.
     */
    public function responseSubmit(Request $request, $pollId, $pollItemId)
    {
        $pollId = Crypt::decrypt($pollId);
        $pollItemId = Crypt::decrypt($pollItemId);

        $pollFind = PollModel::find($pollId);
        $pollItemFind = PollItem::find($pollItemId);

        if ($pollFind && $pollItemFind) {
            if (Auth::check()) {
                $this->processAuthenticatedResponse($request, $pollId, $pollItemId);
            } else {
                $this->processGuestResponse($request, $pollId, $pollItemId);
            }
        }

        $polls = PollModel::activeToday()->first();
        $this->calculatePercentage($request, $polls);
    }

    /**
     * Handles response submission for authenticated users.
     */
    private function processAuthenticatedResponse(Request $request, $pollId, $pollItemId)
    {
        $checkResponse = PollResponse::where('poll_id', $pollId)
            ->where('user_id', Auth::user()->id)
            ->first();

        if (!$checkResponse) {
            $pollResponse = new PollResponse();
            $pollResponse->poll_id = $pollId;
            $pollResponse->poll_item_id = $pollItemId;
            $pollResponse->user_id = Auth::user()->id;
            $pollResponse->save();
            $this->setPollResponseCookie($pollItemId);

            $this->log($request, 'Poll response submitted successfully');
        } else {
            $checkResponse->poll_item_id = $pollItemId;
            $checkResponse->save();
            $this->setPollResponseCookie($pollItemId);

            $this->log($request, 'Poll response updated successfully');
        }
    }

    /**
     * Handles response submission for guest users.
     */
    private function processGuestResponse(Request $request, $pollId, $pollItemId)
    {
        $cookie = $request->cookie('poll_response');
        if (!$cookie || $cookie !== date('Y-m-d')) {
            $pollResponse = new PollResponse();
            $pollResponse->poll_id = $pollId;
            $pollResponse->poll_item_id = $pollItemId;
            $pollResponse->ip_address = $request->ip();
            $pollResponse->save();
            $this->setPollResponseCookie($pollItemId);

            $this->log($request, 'Poll response submitted successfully');
        }
    }

    /**
     * Set the poll response cookie.
     */
    private function setPollResponseCookie($pollItemId)
    {
        $response = ['date' => Carbon::now()->format('Y-m-d'), 'value' => $pollItemId];
        Cookie::queue('poll_response', json_encode($response), 60 * 24 * 7); // 7 days
    }

    /**
     * Calculates the percentage of each poll response.
     */
    private function calculatePercentage($request, $polls)
    {
        $this->data = [];

        if ($polls) {
            $this->data['id'] = $polls->id;
            $this->data['hashId'] = Crypt::encrypt($polls->id);
            $this->data['question'] = $polls->question;

            if (Auth::check()) {
                $this->data['userPollResponse'] = $polls->pollResponses()->active()->where('user_id', Auth::user()->id)->first();
            } else {
                $this->handleGuestUserResponse($request, $polls);
            }

            $pollResponsesCount = PollResponse::where('poll_id', $polls->id)->active()->count();
            $this->mapPollItemsWithResponse($polls, $pollResponsesCount);
        }
    }

    /**
     * Handle guest user response.
     */
    private function handleGuestUserResponse($request, $polls)
    {
        $guestUserResponse = $polls->pollResponses()->active()->where('ip_address', $request->ip())->first();
        if ($guestUserResponse) {
            $cookie = json_decode($request->cookie('poll_response'));
            if ($cookie && $cookie->date == $guestUserResponse->created_at->format('Y-m-d')) {
                $this->data['userPollResponse'] = $guestUserResponse;
            } else {
                $this->data['userPollResponse'] = null;
            }
        }
    }

    /**
     * Maps poll items with their response counts and percentages.
     */
    private function mapPollItemsWithResponse($polls, $pollResponsesCount)
    {
        $pollItems = $polls->items()->where('is_deleted', 0)->get();
        $responseTotals = PollResponse::select('poll_item_id', DB::raw('count(*) as total'))
            ->where('poll_id', $polls->id)
            ->active()
            ->groupBy('poll_item_id')
            ->get();

        foreach ($pollItems as $item) {
            $itemTotal = $responseTotals->firstWhere('poll_item_id', $item->id);
            $total = $itemTotal ? $itemTotal->total : 0;
            $percentage = $pollResponsesCount > 0 ? round(($total / $pollResponsesCount) * 100) : 0;

            $this->data['items'][] = [
                'id' => $item->id,
                'hashId' => Crypt::encrypt($item->id),
                'option' => $item->option,
                'order' => $item->order,
                'total' => $total,
                'percentage' => $percentage,
            ];
        }
    }

    /**
     * Mount the component and load active polls.
     */
    public function mount(Request $request)
    {
        $polls = PollModel::activeToday()->first();
        $this->calculatePercentage($request, $polls);
    }

    /**
     * Renders the poll component view.
     */
    public function render()
    {
        return view('livewire.poll');
    }

    /**
     * Log poll activity.
     */
    public function log(Request $request, $msg = null)
    {
        try {
            $log = [
                'user_id' => Auth::check() ? Auth::user()->id : null,
                'description' => $msg,
                'url' => $request->getRequestUri(),
                'method' => $request->method(),
                'route' => Route::currentRouteName(),
                'ip' => $request->ip(),
                'agent' => $request->userAgent(),
            ];

            //ActivityLogJob::dispatch($log); // Uncomment if needed for background logging

        } catch (\Exception $e) {
            Log::error('Activity Log Error: ' . $e->getMessage());
        }
    }
}
