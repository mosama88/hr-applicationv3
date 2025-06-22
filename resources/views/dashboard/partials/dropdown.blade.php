@php
    use App\Enums\FinanceCalendarsIsOpen;

@endphp
<div class="btn-group">
    <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown"
        aria-expanded="false">
        <i class="fa-solid fa-list-check mx-1"></i> الأجراءات
    </button>
    <ul class="dropdown-menu">
        <li>
            <a class="dropdown-item text-info" href="{{ route('dashboard.' . $name . '.edit', $name_id) }}">
                <i class="fa-solid fa-pen-to-square mx-1"></i> تعديل
            </a>
        </li>
        @if ($info->is_open == FinanceCalendarsIsOpen::Open)
            <li>
                <a class="dropdown-item text-primary" href="{{ route('dashboard.' . $name . '.show', $name_id) }}"> <i
                        class="fa-solid fa-eye mx-1"></i> عرض الشهور
                </a>
            </li>
        @endif

        <form id="delete-form-{{ $name_id }}" action="{{ route('dashboard.' . $name . '.destroy', $name_id) }}"
            method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
        <li>
            <a class="dropdown-item text-danger delete-btn" title="حذف" id="delete_one" data-id="{{ $name_id }}"
                data-bs-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"
                href="#">
                <i class="fa-solid fa-trash-can mx-1"></i> حذف
            </a>
        </li>
        <li>
            <hr class="dropdown-divider">
        </li>
        @if ($info->is_open == FinanceCalendarsIsOpen::Open)
            <li>
                <form action="{{ route('dashboard.financeCalendars.close-year', $name_id) }}" method="POST">
                    @csrf
                    @method('Patch')
                    <button type="submit" class="dropdown-item" style="color:#8F87F1">
                        <i class="fa-solid fa-lock mx-1"></i>غلق السنه
                    </button>
                </form>

            </li>
        @elseif ($info->is_open == FinanceCalendarsIsOpen::Pending)
            <li>
                <form action="{{ route('dashboard.financeCalendars.open-year', $name_id) }}" method="POST">
                    @csrf
                    @method('Patch')
                    <button type="submit" class="dropdown-item text-success"> <i
                            class="fa-solid fa-lock-open mx-1"></i>فتح
                        السنه</button>
                </form>

            </li>
        @else
            <li>
                <button class="dropdown-item text-danger"> <i class="fa-solid fa-folder mx-1"></i>مؤرشف</button>


            </li>
        @endif

        <li>
            <a class="dropdown-item text-dark" href="#">
            </a>
        </li>
    </ul>
</div>



@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Attach event listener to delete buttons
            document.querySelectorAll('.delete-btn').forEach(function(button) {
                button.addEventListener('click', function(event) {
                    event.preventDefault(); // Prevent default behavior

                    // Retrieve the form ID from the button's data attribute
                    const nameId = this.getAttribute('data-id');
                    const form = document.getElementById(`delete-form-${nameId}`);

                    // Display SweetAlert confirmation dialog
                    Swal.fire({
                        title: 'هل أنت متأكد؟',
                        text: 'لن تتمكن من التراجع عن هذا!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'نعم، احذفه!',
                        cancelButtonText: 'إلغاء'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Perform AJAX request
                            fetch(form.action, {
                                    method: 'POST',
                                    body: new FormData(form),
                                    headers: {
                                        'X-CSRF-TOKEN': "{{ csrf_token() }}" // Add CSRF token
                                    }
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        Swal.fire({
                                            title: "تم الحذف",
                                            text: data
                                                .message, // هذه الرسالة تأتي من الـ Controller
                                            icon: 'success',
                                            timer: 1500,
                                            showConfirmButton: false
                                        }).then(() => {
                                            location
                                                .reload(); // Reload the page
                                        });
                                    } else {
                                        Swal.fire({
                                            title: "خطأ!",
                                            text: data.message ||
                                                "حدث خطأ غير متوقع",
                                            icon: 'error'
                                        });
                                    }
                                })
                                .catch(error => {
                                    Swal.fire({
                                        title: "خطأ!",
                                        text: "حدث خطأ غير متوقع",
                                        icon: 'error'
                                    });
                                });
                        }
                    });
                });
            });
        });
    </script>
@endpush
