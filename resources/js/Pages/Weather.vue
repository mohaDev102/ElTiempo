<template>
    <div>
        <h1 class="text-center text-5xl font-blod leading-tight mt-2 mb-2">
            El tiempo en España por municipios
        </h1>
        <div class="relative">
            <div>
                <input type="text" v-model="filtroMunicipio" @input="filtrarMunicipios"
                    class="input-class block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-2 px-3 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    placeholder="Escriba el nombre de un municipio" />
                <ul v-if="municipiosFiltrados.length > 3" class="dropdown">
                    <li v-for="municipio in municipiosFiltrados" :key="municipio.id"
                        @click="seleccionarMunicipio(municipio)">
                        {{ municipio.nombre }}
                    </li>
                </ul>
            </div>
            <select id="municipio" v-model="selectedMunicipio" @change="getWeather"
                class="block appearance-none w-full bg-white border border-gray-300 text-gray-700 py-2 px-3 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                <option value="">Seleccione un municipio</option>
                <option v-for="municipio in municipios" :key="municipio.id" :value="municipio.municipio">
                    {{ municipio.nombre }}
                </option>
            </select>
        </div>
        <div v-if="weatherData && weatherData.length > 0 && weatherData[0].prediccion" class="mt-4">
            <div class="row grid grid-cols-1 sm:grid-cols-4">
                <WeatherCard v-for="(dia, index) in weatherData[0].prediccion.dia" :key="index" :fecha="dia.fecha"
                    :municipio="weatherData[0].nombre"
                    :temperatura="{ maxima: dia.temperatura.maxima, minima: dia.temperatura.minima }"
                    :estadoCielo="getEstadoCielo(dia)" :probPrecipitacion="dia.probPrecipitacion"
                    :humedadRelativa="gethumedadRelativa(dia)" />
            </div>
        </div>
    </div>
</template>
<script>
import { router } from '@inertiajs/vue3';
import WeatherCard from '../Components/WeatherCard.vue';
export default {
    components: {
        WeatherCard,
    },
    props: {
        municipios: Array,
        weatherData: Object,
    },
    data() {
        return {
            selectedMunicipio: '',
            selectedWeatherData: null,
            municipiosFiltrados: [],
            filtroMunicipio: '',
        };
    },
    watch: {
        nombreMunicipio(newVal) {
            if (newVal === '') {
                this.selectedMunicipio = '';
            } else {
                const municipioEncontrado = this.municipios.find(m => m.nombre.toLowerCase() === newVal.toLowerCase());
                this.selectedMunicipio = municipioEncontrado ? municipioEncontrado.id : '';
            }
        },
    },
    methods: {
        async getWeather() {
            try {
                if (this.selectedMunicipio) {
                    router.visit(`/weather/${this.selectedMunicipio}`);
                }
            } catch (error) {
                console.error('Error al obtener el clima:', error);
            }
        },
        getEstadoCielo(dia) {
            console.log(dia);
            return dia.estadoCielo[0].descripcion || 'No disponible';
        },
        gethumedadRelativa(dia)
        {
            return dia.humedadRelativa || 'No disponible';
        },
        filtrarMunicipios() {
            if (this.filtroMunicipio) {
                this.municipiosFiltrados = this.municipios.filter((municipio) =>
                    municipio.nombre.toLowerCase().includes(this.filtroMunicipio.toLowerCase())
                );
            } else {
                this.municipiosFiltrados = [];
            }
        },
        seleccionarMunicipio(municipio) {
            this.municipioSeleccionado = municipio;
            this.filtroMunicipio = municipio.nombre;
            this.municipiosFiltrados = [];
            router.visit(`/weather/${municipio.municipio}`);

        },
    }
};
</script>