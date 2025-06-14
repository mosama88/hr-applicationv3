     <div class="card-footer text-center">
         <button type="submit" id="submitButton" class="btn btn-primary"> <i class="far fa-save mx-1"></i> حفظ
             البيانات</button>
     </div>


     @push('js')
         <script>
             document.getElementById('storeForm').addEventListener('submit', function(event) {
                 var submitButton = document.getElementById('submitButton');
                 submitButton.disabled = true;
                 submitButton.innerHTML = 'جاري الحفظ...'; // Optional: Change text while submitting
             });
         </script>
     @endpush
