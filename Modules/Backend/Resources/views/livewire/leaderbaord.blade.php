<div>

    <div class="col-lg-12 col-md-12">

        <div class="card shadow-1">

            <div class="card-body">
                <div class="row">


                    <div class="col-md-12 my-2">
                        <label for="institute_id" class="form-label">Institute Name</label>
                        <select name="institute_id" id="institute_id"
                            class="form-select @error('instituteId') is-invalid @enderror"
                            aria-label="Default select example" wire:model="instituteId">
                            <option value="">Select Institute</option>
                            @foreach ($institutes as $key => $inst)
                                @if (empty($inst->leaderboard) && !empty($model->id))
                                    <option value="{{ $inst->id }}">{{ $inst->name }}</option>
                                @else
                                    <option value="{{ $inst->id }}">{{ $inst->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('instituteId')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-12 my-2">
                        <input type="checkbox" name="isAllIndia" {{ $isAllIndia == true ? 'checked' : '' }}
                            wire:model="isAllIndia"> All India
                    </div>

                    @if ($isAllIndia == false)

                        <div class="col-md-9">
                            <label for="city_id" class="form-label">City</label>
                            @foreach ($selectedCities as $selectedCity)
                                <input type="hidden" name="city[]" value="{{ $selectedCity }}">
                            @endforeach
                            <select id="city" class="form-control select2 @error('cities') is-invalid @enderror"
                                aria-label="Default select example" wire:model="cities" multiple>
                                @foreach ($citiesOptions as $key => $value)
                                    <option value="{{ $key }}">
                                        {{ $value }}</option>
                                @endforeach
                            </select>

                            @error('cities')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="AddCities" class="form-label">&nbsp;</label>
                            <button type="button" class="btn btn-block btn-outline-primary" id="AddCities"
                                wire:click="addSelectedCity()">Add Cities</button>
                        </div>
                    @endif

                    <div class="col-md-12">
                        @if (count($selectedCities) > 0)
                            <div class="card custom-card shadow-1 mt-3">

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <ol>
                                                @foreach ($selectedCities as $key => $selectedCity)
                                                    {{-- @dd(\App\Helpers\LocationHelper::getAllCitiesWithoutState($selectedCity)->response[0]->city); --}}
                                                    <li class="py-2 fs-6">
                                                        {{ $citiesOptions[$selectedCity] }}
                                                        {{-- {{ \App\Helpers\Helper::cityByCityId($selectedCity)->city }} --}}
                                                        {{-- {{ \App\Helpers\LocationHelper::getAllCitiesWithoutState()->response }} --}}
                                                        <span class="mx-3"></span>
                                                        <button type="button" class="btn btn-sm btn-outline-danger"
                                                            wire:click="removeSelectedCity({{ $selectedCity }})">Remove</button>
                                                    </li>
                                                @endforeach
                                            </ol>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="col-md-12 my-2">
                        <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                            x-on:livewire-upload-finish="isUploading = false"
                            x-on:livewire-upload-error="isUploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress">
                            <label for="banner" class="form-label">Upload Banner (JPEG) (1550 Pixels x 300
                                Pixels)(Max
                                File
                                Size: 100 KB)</label>

                            <input name="banner" type="file"
                                class="form-control @error('banner') is-invalid @enderror" id="banner"
                                wire:model="banner">
                            <div class="progress mg-t-5" x-show="isUploading">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                    role="progressbar" aria-valuemin="0" aria-valuemax="100"
                                    x-bind:style="`width:${progress}%`"></div>
                            </div>
                            @if ($banner)
                                <div class="image-preview">
                                    Banner Preview:
                                    <img src="{{ $banner->temporaryUrl() }}" width="60px" height="60px">
                                </div>
                            @elseif (!empty($uploadedbanner) && Storage::disk('public')->exists($uploadedbanner))
                                <div class="image-preview">
                                    Banner Preview:
                                    <img src="{{ Storage::disk('public')->url($uploadedbanner) }}" width="60px"
                                        height="60px">
                                </div>
                            @endif
                        </div>
                        @error('banner')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
                @if (!empty($model->id))
                    <div class="col-md-12 my-2">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select @error('status') is-invalid @enderror"
                            aria-label="Default select example">
                            <option value="">Select Status</option>
                            <option value="0" {{ $status == 0 ? 'selected' : '' }}>
                                Suspended
                            </option>
                            <option value="1" {{ $status == 1 ? 'selected' : '' }}>
                                Active
                            </option>
                        </select>
                        @error('status')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-12 my-2">
                        <button class="btn btn-outline-success " type="submit">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('style')
        <style>
            .select2 {
                width: 100% !important;
            }
        </style>
        {{-- <link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" /> --}}
    @endsection
    @section('script')
        <!-- INTERNAL Select2 js -->

        {{-- <script src="/assets/plugins/select2/js/select2.full.min.js"></script>
        <script src="/assets/js/select2.js"></script> --}}

        @livewireScripts()
        <script>
            document.addEventListener('livewire:load', function(event) {


                Livewire.hook('message.processed', () => {

                    $('.select2').select2();

                    $('#city').on('change', function(e) {
                        Livewire.emit('citiesListen', $('#city').val())
                    });

                });

               

            });

            $('#city').on('change', function(e) {
                Livewire.emit('citiesListen', $('#city').val())
            });
        </script>
    @endsection
</div>
