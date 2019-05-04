<template>
	<div class="form-group">
		<label :for="name">{{ label }}</label>
		<select :name="name" :id="name" class="form-control" ref="input" @input="updateSelect()">
			<option value="---">---</option>
			<option :value="list.value" v-if="parent == undefined || (parent != undefined && list.parent == parent)" v-for="list in lists">{{ list.label }}</option>
		</select>
	</div>
</template>

<script>
	export default {
		props : [ 'lists', 'label', 'name', 'parent'],
		methods: {
			updateSelect() {
				this.$emit('input', this.$refs.input.value)
			}
		}
	}
</script>
