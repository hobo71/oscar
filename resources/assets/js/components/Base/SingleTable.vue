<template>
    <table class="table table-borderless table-hover" >
      <tbody>
        <tr  >
          <th v-for="values in Object.keys(results)" :key="values.id">
            {{values}} 
          </th>
        </tr>
      </tbody>
      <tbody>
        <tr >
          <td  v-for="(values, key) in Object.values(results)" :key="key">
            {{values}}
          </td>
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
