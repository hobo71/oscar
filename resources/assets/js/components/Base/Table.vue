<template>
    <table class="table table-borderless table-hover" >
      <tbody>
        <tr v-for="values in results" :key="values.id" >
          <td v-for="(i,index) in values" :key="index" >
            {{i}}
          </td>
          <td class="text-right"><base-go :model="model" :id="values.id"></base-go></td>
        </tr>
      </tbody>
    </table>
</template>

<script>
export default {
	props: ['results', 'model']
}
</script>

<style>
</style>
