<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pohon Kinerja - Bappelitbanda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <script src="https://d3js.org/d3.v7.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/d3-org-chart@3.0.1"></script>
    <script src="https://cdn.jsdelivr.net/npm/d3-flextree@2.1.2/build/d3-flextree.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <div class="container-fluid">
        <h4 class="my-2 py-2 border-bottom">POHON KINERJA</h4>
        <div class="row my-3">
            <div class="col">
                <select class="form-select" id="tipe_pokin" aria-label="Default select example">
                    <option selected>Pilih</option>
                    <option value="kota">Kota</option>
                    <option value="perangkat_daerah">Perangkat Daerah</option>
                </select>
            </div>
            <div class="col">
                <select class="form-select" id="nama_pokin" aria-label="Default select example">
                    <option selected>Pilih</option>
                </select>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="chart-container"></div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.min.js" integrity="sha384-RuyvpeZCxMJCqVUGFI0Do1mQrods/hhxYlcVfGPOfQtPJh0JCw12tUAZ/Mv10S7D" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/html2canvas@1.1.4/dist/html2canvas.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>

    <!-- untuk menampilkan select -->
    <script>
        $("#tipe_pokin").change(function() {
            var selectedValue = $(this).val();

            if (selectedValue == "kota") {
                $('#nama_pokin').empty()
                $('#nama_pokin').append('<option value="" disabled selected>Pilih Opsi</option>');

                $(document).ready(function() {
                    $.ajax({
                        url: '/api/misi', // Ulangi dengan route Anda
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $.each(data, function(key, value) {
                                $('#nama_pokin').append('<option value="' + value.id + '">' + value.misi + '. ' + value.keterangan + '</option>');
                            });
                        }
                    });
                });
            } else if (selectedValue == "perangkat_daerah") {
                $('#nama_pokin').empty()
                $('#nama_pokin').append('<option value="" disabled selected>Pilih Opsi</option>');

                $(document).ready(function() {
                    $.ajax({
                        url: '/api/perangkatdaerah', // Ulangi dengan route Anda
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $.each(data, function(key, value) {
                                $('#nama_pokin').append('<option value="' + value.id + '">' + value.keterangan + '</option>');
                            });
                        }
                    });
                });
            }
        })
    </script>
    <!-- untuk menampilkan data -->
    <script>
        $(document).ready(function() {
            $('#tipe_pokin, #nama_pokin').on('change', function() {
                var tipe = $('#tipe_pokin').val();
                var id = $('#nama_pokin').val();

                $.ajax({
                    url: '/api/data',
                    type: 'POST',
                    data: {
                        tipe: tipe,
                        id: id
                    },
                    dataType: 'json',
                    success: function(response) {
                        //  d3 org js untuk pohon kinerja 
                        const data = response.data;

                        let chart = new d3.OrgChart()
                            .nodeWidth((node) => 350)
                            .nodeHeight((node) => 155)
                            .nodeContent((node) => {
                                return `<div style="background-color:${node.data.color_indikator};
                                        width:${node.width}px;
                                        height:${node.height}px;
                                        text-align: center;
                                        outline-style: solid;
                                        outline-color: black"><br><br>
                                            ${node.data.nama_kondisi}
                                        <br><br><br><br>
                                        <div style="background-color:white;
                                        width:350px;
                                        height:75px;
                                        text-align: center;
                                        border-top: 3px solid #000"><br>
                                            ${node.data.indikator}
                                        </div>
                                        </div>`;
                            })
                            .container('.chart-container')
                            .data(data)
                        chart.childrenMargin(node => 100)
                        chart.siblingsMargin(node => 60)
                        chart.linkUpdate(function(d, i, arr) {
                            d3.select(this)
                                .attr("stroke", "black")
                                .attr("stroke-width", 2)
                        })
                        
                        chart.compact(false).render();
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                })

            })
        })
    </script>
</body>

</html>