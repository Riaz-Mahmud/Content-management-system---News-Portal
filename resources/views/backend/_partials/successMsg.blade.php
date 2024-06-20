<div class="alert alert-success alert-dismissible fade show" role="alert" style="background-color: #ffffff;">
    <script>
        setTimeout(function() {
            $('.alert').alert('close');
        }, 3000);
    </script>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

    <h4 class="alert-heading">Success!</h4>
    <p class="mb-0 text-success">
        {{ session('success') }}
    </p>

</div>

