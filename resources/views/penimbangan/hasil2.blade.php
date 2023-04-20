@extends('layout.master2')
@section('content')
    <div class="container-fluid border border-1 rounded shadow shadow-lg p-4 my-5">
        <h3>Data Penimbangan {{ $anak->nama_anak }}</h3>
        <table>
            <tr>
                <td>NIK Anak</td>
                <td>: {{ $anak->nik }}</td>
            </tr>
            <tr>
                <td>Nama Anak</td>
                <td>: {{ $anak->nama_anak }}</td>
            </tr>
            <tr>
                <td>Tanggal Lahir</td>
                <td>: {{ $anak->tanggal_lahir }}</td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>: {{ $anak->jenis_kelamin }}</td>
            </tr>
            <tr>
                <td>Nama Ibu</td>
                <td>: {{ session()->get('ibu')->nama_istri }}</td>
            </tr>
            <tr>
                <td>Nama Ayah</td>
                <td>: {{ session()->get('ibu')->nama_suami }}</td>
            </tr>
        </table>
    </div>

    <div class="table-responsive border border-1 rounded shadow shadow-lg my-5">
        <div class="container-fluid my-4">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#bbModal">
                Grafik Berat Badan
            </button>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#pbModal">
                Grafik Panjang Badan
            </button>
        </div>
    
        <table class="table table-striped border border-1 rounded shadow shadow-lg" id="dtOT">
            <thead>
                <tr>
                <th scope="col">No</th>
                <th scope="col">Bulan Ke</th>
                <th scope="col">Tanggal Timbang</th>
                <th scope="col">Umur</th>
                <th scope="col">Berat Badan</th>
                <th scope="col">Panjang Badan</th>
                <th scope="col">Lingkar Kepala</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($anak->penimbangan as $penimbangan)
                @php
                  if($penimbangan->umur < 365) {
                    $bulan = floor($penimbangan->umur / 30);
                    $hari = $penimbangan->umur % 30;
                    $umur = $bulan . ' Bulan ' . $hari . ' Hari';
                  }else if($penimbangan->umur < 30) {
                    $hari = $penimbangan->umur % 30;
                    $umur = $hari . ' Hari';
                  }else {
                    $tahun = floor($penimbangan->umur / 365);
                    $bulan = floor(($penimbangan->umur % 365) / 30);
                    $hari = $penimbangan->umur - ($tahun * 365) - ($bulan * 30);
                    $umur = $tahun . ' Tahun ' . $bulan . ' Bulan ' . $hari . ' Hari';
                  }
                @endphp
                    <tr>
                        <td scope="row">{{ $loop->index + 1 }}</td>
                        <td>{{ $penimbangan->bulan }}</td>
                        <td>{{ $penimbangan->tanggal_timbang }}</td>
                        <td>{{ $umur }}</td>
                        <td>{{ $penimbangan->bb }} kg</td>
                        <td>{{ $penimbangan->pb }} cm</td>
                        <td>{{ $penimbangan->lk }} cm</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

      <!-- Modal -->
<div class="modal fade" id="bbModal" tabindex="-1" aria-labelledby="bbModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="bbModalLabel">Berat Badan</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-chart-area"></i>
                    Grafik Berat Badan
                </div>
                <div class="card-body"><canvas id="grafikBB" width="100%"></canvas></div>
                <div class="card-footer small text-muted">Jumlah Data: {{ $anak->penimbangan->count() }}</div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
<div class="modal fade" id="pbModal" tabindex="-1" aria-labelledby="pbModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="pbModalLabel">Panjang Badan</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-chart-area"></i>
                    Grafik Panjang Badan
                </div>
                <div class="card-body"><canvas id="grafikPB" width="100%"></canvas></div>
                <div class="card-footer small text-muted">Jumlah Data: {{ $anak->penimbangan->count() }}</div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>

  <script>

    // Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

// Area Chart Example
var bb = document.getElementById("grafikBB");
var pb = document.getElementById("grafikPB");

var bbChart = new Chart(bb, {
  type: 'line',
  data: {
    labels: [
        @foreach($anak->penimbangan as $penimbangan)
            "{{ $penimbangan->tanggal_timbang }}",
        @endforeach
],
    datasets: [{
      label: "Sessions",
      lineTension: 0.3,
      backgroundColor: "rgba(2,117,216,0.2)",
      borderColor: "rgba(2,117,216,1)",
      pointRadius: 5,
      pointBackgroundColor: "rgba(2,117,216,1)",
      pointBorderColor: "rgba(255,255,255,0.8)",
      pointHoverRadius: 5,
      pointHoverBackgroundColor: "rgba(2,117,216,1)",
      pointHitRadius: 50,
      pointBorderWidth: 2,
      data: [
        @foreach($anak->penimbangan as $penimbangan)
            {{ $penimbangan->bb }},
        @endforeach
      ],
    }],
  },
  options: {
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false
        },
        ticks: {
          maxTicksLimit: 7
        }
      }],
      yAxes: [{
        ticks: {
          min: 0,
          max: 30,
          maxTicksLimit: 5
        },
        gridLines: {
          color: "rgba(0, 0, 0, .125)",
        }
      }],
    },
    legend: {
      display: false
    }
  }
});

var pbChart = new Chart(pb, {
  type: 'line',
  data: {
    labels: [
        @foreach($anak->penimbangan as $penimbangan)
            "{{ $penimbangan->tanggal_timbang }}",
        @endforeach
],
    datasets: [{
      label: "Sessions",
      lineTension: 0.3,
      backgroundColor: "rgba(2,117,216,0.2)",
      borderColor: "rgba(2,117,216,1)",
      pointRadius: 5,
      pointBackgroundColor: "rgba(2,117,216,1)",
      pointBorderColor: "rgba(255,255,255,0.8)",
      pointHoverRadius: 5,
      pointHoverBackgroundColor: "rgba(2,117,216,1)",
      pointHitRadius: 50,
      pointBorderWidth: 2,
      data: [
        @foreach($anak->penimbangan as $penimbangan)
            {{ $penimbangan->pb }},
        @endforeach
      ],
    }],
  },
  options: {
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false
        },
        ticks: {
          maxTicksLimit: 7
        }
      }],
      yAxes: [{
        ticks: {
          min: 0,
          max: 30,
          maxTicksLimit: 5
        },
        gridLines: {
          color: "rgba(0, 0, 0, .125)",
        }
      }],
    },
    legend: {
      display: false
    }
  }
});
  </script>

@endsection