<template>
  <Line :chart-data="chartData" :chart-options="chartOptions" />
</template>

<script>
import { Line } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, LineElement, LinearScale, PointElement, CategoryScale, Plugin } from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, LineElement, LinearScale, PointElement, CategoryScale,)

export default {
  name: 'LineChart',  
  components: { Line },
  props: {
    chartData: {
        type: Object,
        required: true
    },
    chartOptions: Object,
    width: Number,
    height: Number,
  }
}
</script>