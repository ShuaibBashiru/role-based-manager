<template>
<div class="">
    <b-overlay class="position-fixed w-100 h-100" :show="showOverlay" no-wrap spinner-variant="primary" rounded="sm" spinner-type="border" z-index="999999" />
  <div class="row">
  <div class="col-md-12">
        <div class="border rounded-3 p-1 pt-0 pb-0">
          <div class="row m-0 p-0 pb-1 pt-1">
              <div class="col-md-6">
            <h6 class="m-0 pt-2" v-text="chartOptions.chartTitle + ' - ' +todayDate"></h6> 
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
           <select v-model="selectedYear" class="form-control shadow-none" @change="plotChart">
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
      <div class="col-md-3 mt-2">
        <div class="border rounded-3 p-1 pt-0 pb-0">
             <div class="row border-bottom m-0 p-0 pb-1 pt-1">
                  <div class="col-md-10">
            <h6 class="m-0 pt-2 pb-2" v-text="chartOptions.total.header"></h6> 
          </div>
              <div class="col-md-2">
              </div>
      </div>
      <div class="row overflow-hidden m-0 mt-2 mb-2">
        <div class="col-md-12">
              <h4 class="mt-4"> <span class="" v-text="formatter(totalPrice)"></span> <br/> <small class="fs-6">YTD</small> </h4>
              <hr>
              <h4 class="mt-4"> <span class="" v-text="totalItems"></span> <br/> <small class="fs-6">Total item orders</small> </h4>
    </div>
    </div>
    </div>
    </div>

  <div class="col-md-9 mt-2">
        <div class="border rounded-3 p-1 pt-0 pb-0 m-0">
      <div class="row border-bottom m-0 p-0 pb-1 pt-1">
              <div class="col-md-8">
            <h6 class="m-0 pt-2 pb-2" v-text="chartOptions.dailyFLows.header +' ('+selectedYear+')'"></h6> 
          </div>
              <div class="col-md-4">
              </div>
    </div>

      <div class="row overflow-hidden m-0 mt-2 mb-2">
        <div class="col-md-12">
            <GChart class="chart" 
            type="LineChart" 
            :data="chartDailyFLows" 
            :resizeDebounce="500"
            :options="chartOptions.dailyFLows" />
        </div>
      </div>
    </div>
    </div>
  </div>

    <hr class="border border-3 border-primary"/>

</div>
</template>
<style scoped>
  .chart {
        width: 99%;
        min-height: 280px;
    }
/* #272953 */
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
        selectedYear: '',
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
          header: 'Today',
          title: '',
          is3D: true,
          stacked: false,
          responsive: true,
          height: 400,
        },
        itemFLows: {
          header: 'Food & Drinks flow',
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
      this.selectedYear = d.getFullYear();
    },
      formatter: function(amount){
        var formatter = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'NGN',
        })
        return formatter.format(amount);
    },
 getRecords: function(){
        this.button='Loading...';
        this.loadStatus='load';
        axios.get('/pos/invoices', {params:this.parameters}).then(response => {
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
      this.totalPlot();
      this.dailyFLows()
    },
  getColumns: function(){
    if (this.selectedYear=='') {
        this.selectedYear = new Date().getFullYear();
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
        console.log(newRecord)
        return newRecord;
        },

      sortInclude: function(needle, record){
      this.sortOrder('date_created');
      var newRecord = []
      for (let i = 0; i < record.length; i++) {
        if (
            record[i].date_created.toString().toLowerCase()==(needle.toString().toLowerCase())
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
        var data = this.sortInclude(this.todayDate, this.allSales);
        for (let index = 0; index < data.length; index++) {
                counter += 1;
                total += parseFloat(this.allSales[index].unit_price);
        }
            this.totalPrice = total;
            this.counter = counter;
            // this.totalItems = this.selectionTotal;

    },

    dailyFLows: function(){
        this.chartDailyFLows=[];
        var selectionTotal = 0;
        this.chartDailyFLows.push(['Item', 'Amount']);
        this.chartOptions.dailyFLows.title = "Daily Sales";
              var data = this.sortInclude(this.todayDate, this.allSales);
              const grouped = _.groupBy(data, info => info.item_name);
              for (var key in grouped){
              var total = 0;
                for (let index = 0; index < grouped[key].length; index++) {
                    selectionTotal += 1;
                    total += parseFloat(this.allSales[index].amount);
                }
              this.chartDailyFLows.push([key.toString(), total])
              }
              this.totalItems = selectionTotal
    },



  },


    }
</script>