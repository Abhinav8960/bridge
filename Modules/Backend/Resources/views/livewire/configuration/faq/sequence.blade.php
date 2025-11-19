<div>
    <div class="row">
        <form class="align-items-center">
            <div class="row">
                <div class="col-md-6">
                    @include('backend::includes._pagesize')
                </div>
                <div class="col-md-6">
                    <div class="row float-end">

                        <div class="col-auto">
                            <label class="visually-hidden" for="search" class="form-label">FAQ Category</label>
                            <select name="search" id="search" wire:model="search" class="form-select">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ !empty($request->category_id) && $request->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->faq_category }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </div>
    <table class="table table-bordered table-striped table-hover mg-b-0 text-md-nowrap" id="faq">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">FAQ Category</th>
                <th scope="col">Question</th>
                <th scope="col">Status</th>
                <th scope="col">Date Created</th>
                <th scope="col">Date Updated</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody wire:sortable="updateSequenceOrder">
            {{-- @if ($faqs->count() > 0) --}}
                @foreach ($faqs as $faq)
                    <tr wire:sortable.item="{{ $faq->id }}">
                        <td scope="col" wire:sortable.handle style="width: 10px; cursor: move;"><i
                                class="fa fa-arrows-alt text-muted"></i></td>
                        <td scope="col">{{ $faq->category->faq_category }}</td>
                        <td scope="col">{{ $faq->question }}</td>
                        <td scope="col"><span
                                class="btn btn-rounded {{ $faq->status == 1 ? 'btn-success' : 'btn-danger' }}">{{ $faq->status == 1 ? 'Active' : 'Suspended' }}</span>
                        </td>
                        <td scope="col">
                            {{ \Carbon\Carbon::parse($faq->created_at)->format('d-m-Y h:i A') }}
                        </td>
                        <td scope="col">
                            {{ \Carbon\Carbon::parse($faq->updated_at)->format('d-m-Y h:i A') }}
                        </td>
                        <td scope="col">
                            <a href="{{ route('configuration.faq.edit', $faq->id) }}" class="btn btn-sm btn-primary"
                                style="float: left" data-bs-placement="top" title="Update"><i
                                    class="fa fa-edit"></i></a>
                            <form style="float: left;margin-left:10px;" method="post"
                                action="{{ route('configuration.faq.destroy', $faq->id) }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" type="submit"
                                    onclick="return confirm('Are you sure you want to delete this item?')"><i
                                        class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            {{-- @else
                <tr>
                    <th colspan="12">No Record Found</th>
                </tr>
            @endif --}}

        </tbody>
    </table>
</div>
