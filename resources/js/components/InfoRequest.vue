<template>
	<div class="bg-green-100">
		{{record.id}} {{record.company_name}}
	</div>
</template>

<script>
    export default {
		data() {
			return {
				record: {
					id: 1,
					company_name: 'Company A'
				}
			}
		},
        mounted() {},
		methods: {
		}
    }
</script>