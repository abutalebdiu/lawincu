@extends(getLayout())


@section("meta_tags")
<title>{{ __("Campaing Details") }}</title>
    <meta name="description" content="Campaing Details and Manage Campaing Details">
    <meta name="keywords" content="campaing,campaing_details">
@endsection

@section('content')

    <section class="content" style="padding-top: 20px">

        <a class="btn btn-secondary mb-3" href="{{ route('campaigns.index') }}">
            Back to list
        </a>
        <div class="card">
            <div class="card-header">
                Campaign Details
            </div>

            <div class="card-body">
                <div class="mb-2">
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <th>
                                    Name
                                </th>
                                <td>
                                    {{ $campaign->name }}
                                </td>
                            </tr>

                            <tr>
                                <th>
                                    Subject
                                </th>
                                <td>
                                    {{ $campaign->subject }}
                                </td>
                            </tr>

                            <tr>
                                <th>
                                    From Name
                                </th>
                                <td>
                                    {{ $campaign->from_name }}
                                </td>
                            </tr>

                            <tr>
                                <th>
                                    From Email
                                </th>
                                <td>
                                    {{ $campaign->from_email }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Reply To
                                </th>
                                <td>
                                    {{ $campaign->reply_to }}
                                </td>
                            </tr>

                            <tr>
                                <th>
                                    Recipients
                                </th>
                                <td>
                                    @if ($campaign->recipients)
                                        @foreach (json_decode($campaign->recipients) as $r)
                                            <span class="badge bg-info">{{ $r }}</span>
                                        @endforeach
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Content
                                </th>
                                <td>
                                    {!! $campaign->content !!}
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>

            </div>
        </div>
        <a class="btn btn-secondary mb-3" href="{{ route('campaigns.index') }}">
            Back to list
        </a>
    </section>


@endsection
