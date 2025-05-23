<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <script src="https://d3js.org/d3.v7.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/d3-org-chart@3.0.1"></script>
    <script src="https://cdn.jsdelivr.net/npm/d3-flextree@2.1.2/build/d3-flextree.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <div class="container-fluid">
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
    <script>
        const data = <?php echo json_encode($data); ?>;

        let chart = new d3.OrgChart()
            .nodeWidth((node) => 400)
            .nodeHeight((node) => 125)
            .nodeContent((node) => {
                return `<div style="background-color:white;
                            width:${node.width}px;
                            height:${node.height}px;
                            text-align: center;
                            outline-style: solid;
                            outline-color: silver"> 
                            <br>
                            ${node.data.nama_kondisi}
                            <br><br><br><br>
                            <div style="background-color: white;
                                width:400px;
                                height:55px;
                                outline-style: solid;
                                outline-color: silver"
                            </div><br>${node.data.indikator}
                            
                        </div>`;
            })
            .container('.chart-container')
            .data(data)
        chart.linkUpdate(function(d, i, arr) {
            d3.select(this)
                .attr("stroke", 'silver')
                .attr("stroke-width", 1)
        })
        chart.compact(false).render();
    </script>

</body>

</html>