<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                {{ date('Y') > '2024' ? '2024 - '.date('Y') : '2024' }} &copy; {{ env('APP_NAME') }}.
            </div>
        </div>
    </div>
</footer>