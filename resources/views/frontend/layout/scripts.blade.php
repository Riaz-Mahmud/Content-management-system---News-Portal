        <!--=============== scripts  ===============-->
               {{-- <script type="text/javascript">
                  function reveal() {
                     var reveals = document.querySelectorAll(".reveal");

                       for (var i = 0; i < reveals.length; i++) {
                         var windowHeight = window.innerHeight;
                          var elementTop = reveals[i].getBoundingClientRect().top;
                           var elementVisible = 150;

                            if (elementTop < windowHeight - elementVisible) {
                             reveals[i].classList.add("active");
                            } else {
                              reveals[i].classList.remove("active");
                              }
                            }
                            }

                     window.addEventListener("scroll", reveal);
                   </script> --}}

<script>

    function markanswer(i)
    {
        poll.selectanswer = +i;

        try{
            document.querySelector(".poll .answers .answer.selected")
            .classList.remove(".selected");
        }
        catch(msg){}

        document.querySelectorAll(".poll .answers .answer")
        [+i].classList.add(".selected");


        showresults();
    }



    function showresults()
    {
        let answers = document.querySelectorAll(".poll .answers .answer");

        for (let i = 0; i < answers.length; i++) {

            let percentage = 0;

            if (i==poll.selectanswer)
            {
                percentage = Math.round
                (
                    (poll.answerweight[i] + 1) * 100 / (poll.pollcount + 1)
                );
            }

            else
            {
                percentage = Math.round
                (
                    (poll.answerweight[i]) * 100 / (poll.pollcount + 1)
                );
            }

            answers[i].querySelector(".percentage_bar").style.width = percentage + "%";
            answers[i].querySelector(".percentage_value").innerText = percentage + "%";

        }
    }
</script>

<script src="{{asset('assets/frontend/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/plugins.js')}}"></script>
<script src="{{asset('assets/frontend/js/scripts.js')}}"></script>
<script src="{{asset('assets/backend/vendor/libs/toastr/toastr.js')}}"></script>
@livewireScripts
{!! Toastr::message() !!}

<script>
    $(document).ready(function() {
        toastr.options.timeOut = 10000;
        @if (Session::has('error'))
            toastr.error('{{ Session::get('error') }}');
        @elseif(Session::has('success'))
            toastr.success('{{ Session::get('success') }}');
        @endif

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error('{{ $error }}');
            @endforeach
        @endif
    });

</script>

<!-- <script src="jquery.js"></script>  -->

@yield('page-js')
