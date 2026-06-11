<script setup>
import {
    Chart as ChartJS,
    CategoryScale,
    LinearScale,
    PointElement,
    LineElement,
    Tooltip,
    Legend
} from 'chart.js';

import { Line } from 'vue-chartjs';

ChartJS.register(
    CategoryScale,
    LinearScale,
    PointElement,
    LineElement,
    Tooltip,
    Legend
);

const props = defineProps({
    chartData: Array
});

const data = {
    labels: props.chartData.map(
        item => item.date
    ),

    datasets: [
        {
            label: 'Transactions',
            data: props.chartData.map(
                item => item.total
            ),
            borderColor: '#06b6d4',
            tension: 0.4
        }
    ]
};
</script>

<template>
    <Line :data="data" />
</template>