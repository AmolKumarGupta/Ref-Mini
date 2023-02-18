  <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
  <footer class="footer py-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mb-4 mx-auto text-center">
            <a href="#" target="_blank" class="text-secondary me-xl-5 me-3 mb-sm-0 mb-2">
                Company
            </a>
            <a href="#" target="_blank" class="text-secondary mb-sm-0 mb-2">
                About Us
            </a>
        </div>

        <div class="col-lg-8 mx-auto text-center mb-4 mt-2">
            <a href="#" target="_blank" class="text-secondary me-xl-4 me-4">
                <span class="text-lg fab fa-dribbble" aria-hidden="true"></span>
            </a>
            <a href="#" target="_blank" class="text-secondary me-xl-4 me-4">
                <span class="text-lg fab fa-twitter" aria-hidden="true"></span>
            </a>
            <a href="#" target="_blank" class="text-secondary me-xl-4 me-4">
                <span class="text-lg fab fa-instagram" aria-hidden="true"></span>
            </a>
            <a href="#" target="_blank" class="text-secondary me-xl-4 me-4">
                <span class="text-lg fab fa-pinterest" aria-hidden="true"></span>
            </a>
            <a href="#" target="_blank" class="text-secondary">
                <span class="text-lg fab fa-github" aria-hidden="true"></span>
            </a>
        </div>

      </div>
      @if (!auth()->user() || \Request::is('static-sign-up')) 
        <div class="row">
          <div class="col-8 mx-auto text-center mt-1">
            <p class="mb-0 text-secondary">
              Copyright © <script>
                document.write(new Date().getFullYear())
              </script> by 
              <a style="color: #252f40;" href="#" class="font-weight-bold ml-1" target="_blank">Ref-Mini</a>.
            </p>
          </div>
        </div>
      @endif
    </div>
  </footer>
  <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
