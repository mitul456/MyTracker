<script setup>
import {
    Chart as ChartJS,
    ArcElement,
    Tooltip,
    Legend
} from 'chart.js';

import { Doughnut } from 'vue-chartjs';

ChartJS.register(
    ArcElement,
    Tooltip,
    Legend
);

const props = defineProps({
    chartData: Array
});

const data = {
    labels: props.chartData.map(
        item => item.category.name
    ),

    datasets: [
        {
            data: props.chartData.map(
                item => item.total
            )
        }
    ]
};
</script>

<template>
    <Doughnut :data="data" />
</template>