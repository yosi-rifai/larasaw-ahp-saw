<hr class="horizontal dark my-1">
<div class="card-body pt-sm-3 pt-0">
    <div class="mt-3">
        <h6 class="mb-0">Sidenav Type</h6>
        <p class="text-sm">Choose between 2 different sidenav types.</p>
    </div>
    <div class="d-flex">
        <button class="btn bg-gradient-dark px-3 mb-2 active" data-class="bg-gradient-dark" onclick="sidebarType(this)">Dark</button>
        <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-transparent" onclick="sidebarType(this)">Transparent</button>
        <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
    </div>
    <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
    <!-- Navbar Fixed -->
    <div class="mt-3 d-flex">
        <h6 class="mb-0">Navbar Fixed</h6>
      <div class="form-check form-switch ps-0 ms-auto my-auto">
        <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
      </div>
    </div>

    <hr class="horizontal dark my-3">
    <div class="mt-2 d-flex">
        <h6 class="mb-0">Light / Dark</h6>
      <div class="form-check form-switch ps-0 ms-auto my-auto">
        <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
      </div>
    </div>
    <hr class="horizontal dark my-sm-4">
    </div>
</div>
</div>
