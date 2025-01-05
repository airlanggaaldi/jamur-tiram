<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Dashboard</title>
</head>

<body class="">
    <section style="background: #E8ECD7;">
        <div class="p-3 d-flex justify-content-center">
            <h1>Sistem Informasi Monitoring Jamur Tiram</h1>
        </div>
    </section>
    <section id="data-card" class="container">
        {{-- <div class="m-5 d-flex justify-content-between">
            <div class="card text-dark bg-light mb-3" style="max-width: 18rem;">
                <div class="card-header">Suhu di Dalam Ruangan</div>
                <div class="card-body">
                    <h5 class="card-title">40°C</h5>
                    <p class="card-text">Suhu Terlalu Panas</p>
                </div>
            </div>
            <div class="card text-dark bg-light mb-3" style="max-width: 18rem;">
                <div class="card-header">Kelembaban Media Tanam</div>
                <div class="card-body">
                    <h5 class="card-title">52.1%</h5>
                    <p class="card-text">Kondisi Normal</p>
                </div>
            </div>
            <div class="card text-dark bg-light mb-3" style="max-width: 18rem;">
                <div class="card-header">Aktivitas Perawatan Jamur</div>
                <div class="card-body">
                    <div class="row align-items-start">
                        <div class="col">Kipas</div>
                        <div class="col">On</div>
                    </div>
                    <div class="row align-items-start">
                        <div class="col">Mist Maker</div>
                        <div class="col">On</div>
                    </div>
                </div>
            </div>
        </div> --}}
    </section>
    <section class="container">
        <div class="p-3 card">
            <div class="card-body">
                <h5 class="mb-3 card-title">Catatan Suhu dan Kelembaban</h5>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Suhu Ruangan</th>
                                <th scope="col">Kelembaban Media</th>
                                <th scope="col">Tanggal - Waktu</th>
                                <th scope="col">Kipas</th>
                                <th scope="col">Mist Maker</th>
                            </tr>
                        </thead>
                        <tbody id="data-monitoring">
                            {{-- @foreach ($monitoring as $data)
                                <tr class="">
                                    <td>{{ $data['suhu'] }}</td>
                                    <td>{{ $data['kelembapan'] }}</td>
                                    <td>{{ $data['created_at'] }}</td>
                                    <td>
                                        @if ($data['status_kipas'] == 'Mati')
                                            <span class="badge rounded-pill text-bg-danger">{{ $data['status_kipas'] }}
                                            </span>
                                        @else
                                            <span class="badge rounded-pill text-bg-success">{{ $data['status_kipas'] }}
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($data['status_mist_maker'] == 'Mati')
                                            <span
                                                class="badge rounded-pill text-bg-danger">{{ $data['status_mist_maker'] }}
                                            </span>
                                        @else
                                            <span
                                                class="badge rounded-pill text-bg-success">{{ $data['status_mist_maker'] }}
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach --}}
                        </tbody>
                    </table>
                </div>

            </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function text_status(text) {
            if (text == 'Menyala') {
                return 'success';
            } else {
                return 'danger';
            }
        };

        $(document).ready(function() {
            // Set CSRF token untuk semua request AJAX
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            function fetchRealtimeData() {
                $.ajax({
                    url: "{{ route('data_monitoring') }}",
                    method: "GET",
                    success: function(data) {
                        let html_monitoring = '';
                        let text_kipas = '';
                        let text_mist = '';
                        data.forEach(function(item) {
                            html_monitoring += `
                            <tr class="">
                                <td> ${item . suhu}°C </td>
                                <td> ${item . kelembapan}% </td>
                                <td> ${item.formatted_created_at} </td>
                                <td>
                                    <span class="badge rounded-pill text-bg-${text_status(item.status_kipas)}">
                                        ${item . status_kipas}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge rounded-pill text-bg-${text_status(item.status_mist_maker)}">
                                        ${item . status_mist_maker}
                                    </span>
                                </td>
                            </tr>
                            `;
                        });
                        $('#data-monitoring').html(html_monitoring);

                        let html_card = '';
                        html_card = `
                        <div class="m-5 d-flex justify-content-between">
                            <div class="card text-dark bg-light mb-3" style="max-width: 18rem;">
                                <div class="card-header">Suhu di Dalam Ruangan</div>
                                <div class="card-body">
                                    <h5 class="card-title">${data[0].suhu}°C</h5>
                                    <p class="card-text">Suhu Terlalu Panas</p>
                                </div>
                            </div>
                            <div class="card text-dark bg-light mb-3" style="max-width: 18rem;">
                                <div class="card-header">Kelembaban Media Tanam</div>
                                <div class="card-body">
                                    <h5 class="card-title">${data[0].kelembapan}%</h5>
                                    <p class="card-text">Kondisi Normal</p>
                                </div>
                            </div>
                            <div class="card text-dark bg-light mb-3" style="max-width: 18rem;">
                                <div class="card-header">Aktivitas Perawatan Jamur</div>
                                <div class="card-body">
                                    <div class="row align-items-start mb-1">
                                        <div class="col">Kipas</div>
                                        <div class="col">
                                            :
                                            <span class="badge rounded-pill text-bg-${text_status(data[0].status_kipas)}">
                                                ${data[0].status_kipas}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="row align-items-start">
                                        <div class="col">Mist Maker</div>
                                        <div class="col">
                                            :
                                            <span class="badge rounded-pill text-bg-${text_status(data[0].status_mist_maker)}">
                                                ${data[0].status_mist_maker}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        `;
                        $('#data-card').html(html_card);
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            }

            // Panggil setiap 5 detik
            setInterval(fetchRealtimeData, 5000);
            fetchRealtimeData(); // Panggil pertama kali
        });
    </script>
</body>

</html>
