@extends(getLayout())

@section('meta_tags')
    <title>{{ __('Company Details') }}</title>
    <meta name="description" content="Company List and Manage Company Details">
    <meta name="keywords" content="company,company_details">
@endsection

@section('content')
    <section class="content" style="padding-top: 20px">

        <div class="d-flex justify-content-between">
            <a class="btn btn-secondary mb-3" href="{{ route('companies.index') }}">
                {{ __('Back to list') }}
            </a>
            {{-- <div>
                <a class="btn btn-primary mb-3" href="{{ route("mail-message.index", ["email" => $company->email]) }}">
                    Send Message
                </a>
                <a class="btn btn-info mb-3" href="{{ route("contacts.index") }}">
                    Schedule Activity
                </a>
            </div> --}}
            <a class="btn btn-primary mb-3" href="#" data-bs-toggle="modal" data-bs-target="#addusermodal">
                {{ __('Add User') }}
            </a>
            <!-- Modal -->
            <div class="modal fade" id="addusermodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form class="modal-content" method="POST" action="{{ route("companyuser.add") }}">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{ __("Add User to ").$company->name }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                                @csrf
                                <div class="form-group">
                                    <label class="required" for="name">{{ __('Name') }}</label>
                                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                                    @if($errors->has('name'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('name') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label class="required" for="email">{{ __('Email') }}</label>
                                    <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', '') }}" required>
                                    @if($errors->has('email'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('email') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label class="required" for="phone">{{ __('Phone') }}</label>
                                    <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', '') }}" required>
                                    @if($errors->has('phone'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('phone') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label class="required" for="password">{{ __('Password') }}</label>
                                    <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" id="password" autocomplete="new-password" required>
                                    @error("password")
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>


                                <div class="mb-3">
                                    <label class="required" for="role">{{ __('Company Role') }}</label>
                                    <select name="role" id="role" class="form-control @error('role') is-invalid @enderror" required>
                                        <option value="">{{ __("Select Role") }}</option>
                                        <option value="0">{{ __("Full Access") }}</option>
                                        @foreach ($subroles as $subrole)
                                            <option value="{{ $subrole->id }}">{{ $subrole->title }}</option>
                                        @endforeach
                                    </select>
                                    @error("role")
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="company" value="{{ $company->id }}">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                {{ __('Company Details') }}
            </div>

            <div class="card-body">
                <div class="mb-2">
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <th>
                                    {{ __('Company Name') }}
                                </th>
                                <td>
                                    {{ $company->name }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ __('Logo') }}
                                </th>
                                <td>
                                    <a target="_blank"
                                        href="{{ asset($company->logo ? "uploads/logo/$company->logo" : 'images/company.png') }}">
                                        <img width="50"
                                            src="{{ asset($company->logo ? "uploads/logo/$company->logo" : 'images/company.png') }}"
                                            alt="Slider image" class="img-fluid">
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ __('Email') }}
                                </th>
                                <td>
                                    {{ $contact->email }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ __('Phone') }}
                                </th>
                                <td>
                                    {{ $contact->phone }}
                                </td>
                            </tr>

                            <tr>
                                <th>
                                    {{ __('Mobile') }}
                                </th>
                                <td>
                                    {{ $contact->mobile }}
                                </td>
                            </tr>

                            <tr>
                                <th>
                                    {{ __('Country') }}
                                </th>
                                <td>
                                    {{ $contact->country->name ?? '' }}
                                </td>
                            </tr>

                            <tr>
                                <th>
                                    {{ __('State') }}
                                </th>
                                <td>
                                    {{ $contact->state->name ?? '' }}
                                </td>
                            </tr>

                            {{-- <tr>
                                <th>
                                    {{ __('City') }}
                                </th>
                                <td>
                                    {{ $contact->city ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ __('Zip Code') }}
                                </th>
                                <td>
                                    {{ $contact->zip_code ?? '' }}
                                </td>
                            </tr> --}}
                            <tr>
                                <th>
                                    {{ __('Address') }}
                                </th>
                                <td>
                                    {{ $contact->address }} {{ $contact->address_2 }}
                                </td>
                            </tr>

                        </tbody>
                    </table>

                </div>

            </div>
        </div>

        <div class="card">
            <div class="card-header">
                {{ __('Company Users') }}
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>{{ __('Email') }}</th>
                            <th>{{ __('Role') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($company->users as $user)
                            <tr>
                                <td>{{ $user->email }}</td>
                                @php
                                    $subrole = null;
                                @endphp
                                @if ($user->pivot->subrole_id == null)
                                    <td>{{ __('Full Access') }}</td>
                                @else
                                    @php
                                        $subrole = \SalimHosen\Core\Models\Subrole::find($user->pivot->subrole_id);
                                    @endphp
                                    <td>{{ $subrole->title ?? '' }}</td>
                                @endif
                                <td>
                                    @if (Auth::user()->id != $user->id)
                                        <x-core-delete-dialog :id="$user->id" :action="route('companyuser.remove', $user->id)"></x-core-delete-dialog>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <a class="btn btn-secondary mb-3" href="{{ route('companies.index') }}">
            {{ __('Back to list') }}
        </a>
    </section>
@endsection
