@if($errors->any())
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="errorModalLabel">Errors</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger">
          <ul>
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        <div class="progress">
          <div id="progressBar" class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
      </div>
    </div>
  </div>
</div>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function() {
      @if($errors->any())
        var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
        var progressBar = document.getElementById('progressBar');
        var duration = 3000; // 3000 milliseconds = 3 seconds
        var stepTime = 100; // Update every 100 milliseconds
        var steps = duration / stepTime;
        var currentStep = 0;
  
        function updateProgressBar() {
          currentStep++;
          var percentage = 100 - (currentStep / steps * 100);
          progressBar.style.width = percentage + '%';
          if (currentStep < steps) {
            setTimeout(updateProgressBar, stepTime);
          } else {
            errorModal.hide();
          }
        }
  
        errorModal.show();
        setTimeout(updateProgressBar, stepTime);
      @endif
    });
  </script>
  