              <div class="card-footer text-center">
                  <button type="submit" id="submitButton" class="btn btn-info"> <i class="fas fa-marker mx-1"></i>
                      تعديل
                      البيانات</button>
              </div>


              @push('js')
                  <script>
                      //التعديل
                      document.getElementById('updateForm').addEventListener('submit', function(event) {
                          var submitButton = document.getElementById('submitButton');
                          submitButton.disabled = true;
                          submitButton.innerHTML = 'جاري التعديل...'; // Optional: Change text while submitting
                      });
                  </script>
              @endpush
