@extends('layouts.master')

@push('scripts')
<script defer src="/js/vue/app.js"></script>
<script>
    window.initialValues = {};
    window.initialValues.images = {{ $images }};
</script>
@endpush

@section('content')

<x-h2>Vue: collection with custom property</x-h2>

<form method="POST" ref="form">
    @csrf

    <x-grid>
        <x-field label="name">
            <x-input id="name" name="name" placeholder="Your first name" value="{{ old('name', $formSubmission->name) }}" />
        </x-field>
            
        <x-field label="images">
            <media-library-collection
                name="images"
                :initial-value="window.oldValues.images || window.initialValues.images"
                upload-endpoint="/temp-upload"
                :validation="{ accept: ['image/png', 'image/jpeg'] }"
                :validation-errors="window.errors"
                :max-items="3"
            >
                <template
                    slot="fieldsView"
                    slot-scope="{
                        getCustomPropertyInputProps,
                        getCustomPropertyInputListeners,
                        getCustomPropertyInputErrors,
                        getNameInputProps,
                        getNameInputListeners,
                        getNameInputErrors,
                    }"
                >
                    <div class="medialibrary-properties">
                        <div class="medialibrary-field">
                            <label class="medialibrary-label">Name</label>
                            <input
                                class="medialibrary-input"
                                v-bind="getNameInputProps()"
                                v-on="getNameInputListeners()"
                            />
                            <p v-for="error in getNameInputErrors()" :key="error" class="medialibrary-text-error">
                                @{{ error }}
                            </p>
                        </div>

                        <div class="medialibrary-field">
                            <label class="medialibrary-label">Extra field</label>
                            <input
                                class="medialibrary-input"
                                v-bind="getCustomPropertyInputProps('extra_field')"
                                v-on="getCustomPropertyInputListeners('extra_field')"
                            />
                            <p v-for="error in getCustomPropertyInputErrors('extra_field')" :key="error" class="medialibrary-text-error">
                                @{{ error }}
                            </p>
                        </div>
                    </div>
                </template>
            </media-library-collection>
        </x-field>

        <x-button data-testing-role="submit">Submit</x-button>
    </x-grid>
</form>

@endsection

<!--  -->
