<template>

    <section class="section-content bg padding-y border-top">

        <div class="container">
            <div class="row">
                <canvas ref="chart"></canvas>
            </div>
        </div>


        <div class="container">
            <div class="row">
                <main class="col-sm-12">
                    <div class="tile">
                        <div class="tile-body">
                            <table class="table table-hover table-bordered rwd-table" id="sampleTable">
                                <thead>
                                <tr>
                                    <th class="text-center">Client</th>
                                    <th class="text-center">Product</th>
                                    <th class="text-center">Total</th>
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="value in values.data">
                                    <td data-th="Client">{{ value.client.client }}</td>
                                    <td data-th="Product">{{ value.product }}</td>
                                    <td data-th="Total">{{ value.total }}</td>
                                    <td data-th="Date">{{ value.date }}</td>
                                    <td class="text-right" data-th="Action">
                                        <a href="" class="btn btn-outline-primary"><i class="fa fa-times"></i>
                                            Edit
                                        </a>
                                        <a href="" class="btn btn-outline-danger"><i class="fa fa-times"></i>
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <pagination :data="values" @pagination-change-page="loadValues"></pagination>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </section>
</template>

<script>

    export default {
        name: "report-orders",

        mounted() {
            console.log('Component mounted.')
        },
        data() {
            return {
                values: {},
            }
        },
        created() {
            this.loadValues();
        },
        methods: {
            loadValues(page) {

                if (typeof page === 'undefined') {
                    page = 1;
                }

                this.$http.get('/order-products?page=' + page)
                    .then(response => {
                        return response.json();
                    }).then(data => {
                    // this.values = data.data;
                    this.values = data.products;
                    // this.values = data;
                    console.log(data);

                    this.chartData(data);

                });

            },
            chartData(data) {
                var chart = this.$refs.chart;
                var ctx = chart.getContext("2d");

                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: data.labels,
                        datasets: [{
                            label: '# Chart data',
                            data: data.dataSet,
                            borderWidth: 1,
                            backgroundColor: '#ff6384',
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            },
        },
    };

</script>


<style scoped>

</style>
