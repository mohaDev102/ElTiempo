<template>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <div class="bg-blue-500 rounded-lg overflow-hidden shadow-lg text-white m-4 justify-center items-center">
        <div class="px-3 py-2">
            <div class="municipio flex justify-between items-center">
                <div>{{ municipio }}</div>
                <div class="font-bold text-xl mb-2">{{ formatDay(fecha) }}</div>
            </div>
            <div class="flex justify-between items-center">
                <div>
                    <div class="text-sm">High: {{ temperatura.maxima }}°C - Low: {{ temperatura.minima }}°C</div>
                </div>
            </div>
            <div class="flex justify-between items-center mt-2">
                <div class="flex items-center">
                    <i :class="getWeatherIcon(estadoCielo)" class="text-3xl"></i>
                    <span class="ml-2">{{ estadoCielo }}</span>
                </div>
                <div class="text-sm">
                    {{ probPrecipitacion[0]?.value || 0 }}%
                </div>
            </div>
        </div>
        <div class="px-6 pt-4 pb-2 bg-blue-600">
            <div class="text-center mt-2">
                <a href="#" class="text-blue-200 text-sm">More +</a>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        municipio: {
            type: String,
            required: true,
        },
        fecha: {
            type: String,
            required: true,
        },
        temperatura: {
            type: Object,
            required: true,
        },
        estadoCielo: {
            type: Object,
            required: true,
        },
        probPrecipitacion: {
            type: Array,
            required: true,
        },
    },
    methods: {
        formatDay(dateString) {
            return new Date(dateString).toLocaleDateString('es-ES', { weekday: 'long', day: 'numeric', month: 'long' });
        },
        getWeatherIcon(description) {
            const iconMap = {
                'Despejado': 'fas fa-sun',
                'Nuboso': 'fas fa-cloud',
                'Cubierto': 'fas fa-cloud',
                'Cubierto con lluvia': 'fas fa-cloud-rain',
                'Muy nuboso con lluvia': 'fas fa-cloud-showers-heavy',
                'Muy nuboso con tormenta': 'fas fa-poo-storm',
                'Intervalos nubosos con lluvia escasa': 'fas fa-cloud-rain',
                'Intervalos nubosos': 'fas fa-cloud-sun',
                'Nuboso con lluvia': 'fas fa-cloud-rain',
                'Intervalos nubosos con nieve': 'fas fa-snowflake',
                'Nuboso con nieve': 'fas fa-snowflake',
                'Muy nuboso con nieve': 'fas fa-snowflake',
                'Cubierto con nieve': 'fas fa-snowflake',
            };
            return iconMap[description] || '';
        }

    }
};
</script>
  