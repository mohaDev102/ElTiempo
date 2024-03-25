<template>
    <div class="max-w-md mx-auto mt-10">
    <label for="municipio" class="block text-sm font-medium text-gray-700">Selecciona un municipio</label>
    <select id="municipio" v-model="selectedMunicipio" @change="fetchWeather" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
      <option v-for="municipio in municipios" :key="municipio.id" :value="municipio.id">{{ municipio.nombre }}</option>
    </select>
    <!-- Mostrar datos del tiempo aquí -->
  </div>
</template>

<script>
export default {
  data() {
    return {
      municipios: [], // Asumiendo que tienes una lista de municipios
      selectedMunicipio: null,
    };
  },
  methods: {
    async fetchWeather() {
      if (!this.selectedMunicipio) return;
      const response = await fetch(`API_URL/api/prediccion/especifica/municipio/diaria/${this.selectedMunicipio}?api_key=TU_API_KEY`);
      const data = await response.json();
      // Procesa y muestra los datos del tiempo
    },
  },
  mounted() {
    // Cargar municipios aquí si es necesario
  }
};
</script>