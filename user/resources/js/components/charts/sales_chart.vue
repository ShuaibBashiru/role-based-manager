<template>
<div class="">
    <b-overlay class="position-fixed w-100 h-100" :show="showOverlay" no-wrap spinner-variant="primary" rounded="sm" spinner-type="border" z-index="999999" />
  <div class="row">
  <div class="col-md-12">
        <div class="border rounded-3 p-1 pt-0 pb-0">
          <div class="row m-0 p-0 pb-1 pt-1">
              <div class="col-md-6">
            <h6 class="m-0 pt-2" v-text="chartOptions.chartTitle"></h6> 
          </div>
              <div class="col-md-6 pe-0 dropdown">
            <button class="btn btn-primary float-end pt-1 pb-1" data-bs-toggle="dropdown" aria-expanded="false">Actions</button> 
            <button class="btn float-end me-2 pt-1 pb-1 btn-outline-primary" @click="getRecords"><i class="bi-arrow-clockwise"></i> 
            <span v-text="button"> </span> <span v-if="loadStatus=='load'" class="spinner-border spinner-border-sm text-primary"></span>
            </button> 
        <div class="dropdown-menu w-75 mt-0 pt-0" style="width: 200px !important;">
        <ul class="list-unstyled pb-1 border-bottom" onclick="event.stopPropagation()">
        <li class="mb-2">
        <p class="align-items-center ps-2 p-1 mb-0 collapsed dropdown-item" data-bs-toggle="collapse" data-bs-display="static" data-bs-target="#drop3" aria-expanded="false">
        <i class="bi bi-list-task me-1"></i> <span>Filter</span></p>
        <div class="collapse" id="drop3">
        <ul class="btn-toggle-nav ms-2 list-unstyled fw-normal pb-1 small">
        <li class="p-1">
           <select v-model="parameters.year" class="form-control shadow-none" @change="plotChart">
                <option value="" selected>Select</option>
                <option v-for="(d, index) in years" :value="d" :key="index" v-text="'Year '+d"></option>
            </select>
        </li>
        </ul>
        </div>
        </li>
    </ul>
    
  </div>
        </div>
      </div>
      </div>
  </div>
  </div>

 <div class="row bg-primary text-white rounded pt-3 pb-3 m-0 mt-2">
          <div class="col-md-4 mt-2">
        <div class="border rounded-3 p-1 pt-0 pb-0">
             <div class="row border-bottom m-0 p-0 pb-1 pt-1">
                  <div class="col-md-10">
            <h6 class="m-0 pt-2 pb-2" v-text="chartOptions.total.header +' ('+parameters.year+')'"></h6> 
          </div>
              <div class="col-md-2">
              </div>
      </div>
      <div class="row overflow-hidden m-0 mt-2 mb-2">
        <div class="col-md-12">
              <h4 class="mt-3"> <span class="" v-text="counter"></span> <br/> <small class="fs-6">Total invoice</small></h4>
              <hr>
              <h4 class="mt-4"> <span class="" v-text="valueConverter(totalPrice)"></span> <br/> <small class="fs-6">YTD</small> </h4>
              <hr>
              <h4 class="mt-4"> <span class="" v-text="totalItems"></span> <br/> <small class="fs-6">Total item orders</small> </h4>
    </div>
    </div>
    </div>
    </div>

  <div class="col-md-8 mt-2">
        <div class="border rounded-3 p-1 pt-0 pb-0 m-0">
      <div class="row border-bottom m-0 p-0 pb-1 pt-1">
              <div class="col-md-8">
            <h6 class="m-0 pt-2 pb-2" v-text="chartOptions.summary.header +' ('+parameters.year+')'"></h6> 
          </div>
              <div class="col-md-4">
              </div>
      </div>
       <div class="row overflow-hidden m-0 mt-2 mb-2">
        <div class="col-md-12">
            <section v-if="info.length > 0">
            <GChart class="chart" 
              type="ColumnChart" 
              :data="chartSummary" 
              :resizeDebounce="500"
              :options="chartOptions.summary" />
           </section>
           <section v-else>
            <p class="text-center text-white blinker">Fetching...</p>
           </section>
          
        </div>
      </div>
    </div>
    </div>
  </div>

</div>
</template>
<style scoped>
  .chart {
        width: 99%;
        min-height: 280px;
    }

</style>
<script>
import { GChart } from 'vue-google-charts/legacy'
export default {
  name: 'sales_chart',
  props: ['server_message'],
  components: {
    GChart
  },
  data (){
    return{
        alertTitle: '',
        alertMsg: '',
        showOverlay: false,
        info: [],
        totalRecord: [],
        allSales: [],
        loadStatus: 'load',
        progress: null,
        btntxt: 'Refresh',
        button: 'Refresh',
        errors: [],
        selectionTotal: 0,
        years: [],
        parameters:{
            year: '',
            month: '',
            day: '',
        },
        todayDate: '',
        totalPrice: 0,
        counter: 0,
        totalItems: 0,
        chartSummary: [],
        chartItemFLows: [],
        chartDailyFLows: [],
        chartOptions: {
        chartTitle: "Sales Report",
        summary: {
          header: 'Summary in Year',
          title: '',
          is3D: true,
          stacked: false,
          responsive: true,

        },
        dailyFLows: {
          header: 'Daily flow',
          title: '',
          is3D: true,
          stacked: false,
          responsive: true,
          height: 400,
        },
  
         total: {
          header: 'Invoiced',
          title: '',
          is3D: true,
          stacked: false,
          responsive: true,
        },
        },
            months: {
              '01': 'Jan',
              '02': 'Feb',
              '03': 'Mar',
              '04': 'Apr',
              '05': 'May',
              '06': 'June',
              '07': 'July',
              '08': 'Aug',
              '09': 'Sept',
              '10': 'Oct',
              '11': 'Nov',
              '12': 'Dec',
            },
    }
  },

  created(){
    this.getDateInfo();
    this.getRecords();
  },
  mounted(){
        this.refresh();
  },
  methods:{

    getDateInfo: function(){
      var d = new Date();
      var m = d.getMonth().toString().length === 1?  d.getMonth()+1 : d.getMonth();
      var month = m.toString().length===1? '0'+m.toString() : m.toString();
      var day = d.getDate().toString().length===1? '0'+d.getDate().toString() : d.getDate().toString()
      this.todayDate = d.getFullYear() + '-' + month + '-' +day;
      this.parameters.year = d.getFullYear()
      this.parameters.month = month
      this.parameters.day = day
    },
    valueConverter: function(amount){
        var formatter = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'NGN',
        })
        return formatter.format(amount);
    },

 getRecords: function(){
        this.button='Loading...';
        this.loadStatus='load';
        axios.get('/pos2/invoices', {params:this.parameters}).then(response => {
            if((response.status != undefined && response.status==200) && (response['data'].data.status==response['data'].data.statusmsg)){
            this.info = response['data'].data.info;
            this.totalRecord = response['data'].data.info;
            this.allSales = response['data'].data.sales;
            this.plotChart();
            this.button=this.btntxt;
            this.loadStatus=true;
            }else if(response['data'].data.status=='norecord'){
            this.responseStatus = response['data'].data.msg
            this.info = ''
            this.alertMsg=''
            this.button=this.btntxt;
            this.loadStatus=true;
            }else{
            this.alertMsg=response['data'].data.msg;
            this.button=this.btntxt;
            this.loadStatus=true;
            }
        }).catch(error => {
                this.button=this.btntxt;
                this.errors = '';
                this.loadStatus=true;
            if(error.response != undefined && error.response.status==422){
                this.errors = error.response.data.errors;
                this.alertMsg='Something went wrong! Kindly confirm and correct the error(s) before you continue.'
            } else if(error.response != undefined && error.response.status==419){
                this.alertMsg='This page has been inactive for long, Kindly refresh and try again.';
            }else if(error.response != undefined && error.response.status==500){
                this.alertMsg='Internal server error! Please refresh and try again or report this error.';
            }else{
                this.alertMsg='Access restricted or Network error! Please refresh and try again or report this error.';
            }
        })
    },
  
  refresh: function(){
       this.plotChart()
  },  

  plotChart: function(){
      this.getColumns();
      this.summaryPlot();
      this.totalPlot();
    },
  getColumns: function(){
    if (this.parameters.year=='') {
        this.parameters.year = new Date().getFullYear();
    }else{
      this.years = [];
      const years = _.groupBy(this.info, info => info.date_created.substring(0, 4));
      for(var key in years){
        this.years.push(key);
      }
    }
 
  },
  sortData: function(needle, record){
      this.sortOrder('date_created');
      var newRecord = []
      for (let i = 0; i < record.length; i++) {
        if (
            record[i].date_created.toString().toLowerCase().search(needle.toString().toLowerCase())!=-1
            ){
          newRecord.push(record[i]);
        }
        }
        return newRecord;
        },

    sortOrder: function(column, record){
    try {
            record.sort((a, b) =>{
            let s1 = a[column].toString().toLowerCase()
            let s2 = b[column].toString().toLowerCase()
            return s1.localeCompare(s2);
        })
        } catch (error) {
            return false;
        }
    },

    totalPlot: function(){
      this.chartOptions.total.title = "Invoiced";
        var total = 0;
        var counter = 0;
        var data = this.sortData(this.parameters.year, this.info);
        for (let index = 0; index < data.length; index++) {
                counter += 1;
                total += parseFloat(this.info[index].totalPrice);
        }
            this.totalPrice = total;
            this.counter = counter;
            this.totalItems = this.allSales.length;
    },

  summaryPlot: function(){
    this.chartSummary=[];
    this.selectionTotal = 0;
    this.chartSummary.push(['Month', 'Total sales']);
    this.chartOptions.summary.title = "Total sales by Months";
          var data = this.sortData(this.parameters.year, this.info);
          const grouped = _.groupBy(data, info => info.date_created.substring(5, 7));
          for (var key in grouped){
          var total = 0;
          for (let index = 0; index < grouped[key].length; index++) {
              this.selectionTotal += 1;
              total += parseFloat(data[index].totalPrice);
          }
          this.chartSummary.push([this.months[key].toString(), total])
          }

    },
  },


    }
</script>