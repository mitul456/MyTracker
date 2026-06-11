<script setup>
import {
    Chart as ChartJS,
    CategoryScale,
    LinearScale,
    BarElement,
    Tooltip,
    Legend
} from 'chart.js';

import { Bar } from 'vue-chartjs';

ChartJS.register(
    CategoryScale,
    LinearScale,
    BarElement,
    Tooltip,
    Legend
);

const props = defineProps({
    chartData: Array
});

const data = {
    labels: props.chartData.map(i => i.date),

    datasets: [
        {
            label: 'Income',
            data: props.chartData.map(i => i.income),
            backgroundColor: '#10b981'
        },
        {
            label: 'Expense',
            data: props.chartData.map(i => i.expense),
            backgroundColor: '#ef4444'
        }
    ]
};
</script>

<template>
    <Bar :data="data" />
</template>