@php
    use App\Enums\StatusActiveEnum;
@endphp
<div>
    <div class="row">
        <div class="col-md-6 mx-2 mb-4 mt-3">
            <div class="input-group">
                <span class="input-group-text" id="basic-addon1">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </span>
                <input type="text" wire:model.live="name" class="form-control" placeholder="إبحث بالاسم">
                @if (empty($name))
                    <button class="btn btn-light" disabled>أمسح</button>
                @else
                    <button wire:click.prevent="clear()" class="btn btn-success">أمسح</button>
                @endif
            </div>
        </div>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>أسم البدل</th>
                    <th>الحالة</th>
                    <th>أضافة بواسطة</th>
                    <th>تعديل بواسطة</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @forelse ($data as $info)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $info->name }}</td>
                        <td>
                            @if ($info->active == StatusActiveEnum::ACTIVE)
                                <span class="badge bg-success">مفعل</span>
                            @else
                                <span class="badge bg-danger">غير مفعل</span>
                            @endif
                        </td>
                        <td>{{ $info->createdBy->name }}</td>
                        <td>
                            @if ($info->updated_by > 0)
                                {{ $info->updatedBy->name }}
                            @else
                                لا يوجد تحديث
                            @endif

                        </td>

                        <td>
                            @include('dashboard.partials.actions', [
                                'name' => 'allowances',
                                'name_id' => $info->slug,
                            ])
                        </td>
                    </tr>
                @empty
                    <div class="alert alert-secondary" role="alert">عفوآ لا توجد بيانات!</div>
                @endforelse
            </tbody>
        </table>
        <div class="row">
            <div class="col-12 my-2">
                {{ $data->links() }}
            </div>
        </div>
    </div>
</div>
