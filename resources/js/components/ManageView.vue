<template>

<div class="container mx-auto py-4">
	<table class="bg-white">
		<caption>
			<input type="search" v-model="query"
				placeholder="Buscar..."
				v-on:keyup="search"
				class="w-full text-left p-4 bg-gray-100 border-4">
		</caption>
		<thead>
			<tr class="cursor-pointer whitespace-nowrap text-left font-semibold">
				<th class="p-2 border-b"  @click="toggle_sort('id')">
					Id
					<span v-if="sort_order==='id'" class="rounded-full bg-gray-100 inline-block w-6 v-6 text-center">
						<b v-if="sort_direction==='asc'">&uarr;</b>
						<b v-if="sort_direction==='desc'">&darr;</b>
					</span>
				</th>
				<th class="p-2 border-b" @click="toggle_sort('company_name')">
					Empresa
					<span v-if="sort_order==='company_name'" class="rounded-full bg-gray-100 inline-block w-6 v-6 text-center">
						<b v-if="sort_direction==='asc'">&uarr;</b>
						<b v-if="sort_direction==='desc'">&darr;</b>
					</span>
				</th>
				<th class="p-2 border-b text-right" @click="toggle_sort('annual_income')">
					Ingresos anuales
					<span v-if="sort_order==='annual_income'" class="rounded-full bg-gray-100 inline-block w-6 v-6 text-center">
						<b v-if="sort_direction==='asc'">&uarr;</b>
						<b v-if="sort_direction==='desc'">&darr;</b>
					</span>
				</th>
				<th class="p-2 border-b" @click="toggle_sort('contact_name')">
					Contacto
					<span v-if="sort_order==='contact_name'" class="rounded-full bg-gray-100 inline-block w-6 v-6 text-center">
						<b v-if="sort_direction==='asc'">&uarr;</b>
						<b v-if="sort_direction==='desc'">&darr;</b>
					</span>
				</th>
				<th class="p-2 border-b" @click="toggle_sort('created_at')">
					Fecha
					<span v-if="sort_order==='created_at'" class="rounded-full bg-gray-100 inline-block w-6 v-6 text-center">
						<b v-if="sort_direction==='asc'">&uarr;</b>
						<b v-if="sort_direction==='desc'">&darr;</b>
					</span>
				</th>
				<th class="p-2 border-b">Gestionado</th>
				<th class="p-2 border-b"></th>
			</tr>
		</thead>
		<tr v-for="request in requests" :key="request.id">
			<td class="p-2 border-b">{{request.id}}#</td>
			<td class="p-2 border-b">{{request.company_name}}</td>
			<td class="p-2 border-b text-right">{{request.annual_income}}</td>
			<td class="p-2 border-b">
				{{request.contact_name}}
				<div class="text-sm">{{request.contact_email}}</div>
				<div class="text-sm">{{request.contact_phone}}</div>
			</td>
			<td class="p-2 border-b whitespace-nowrap">
				{{ new Date(request.created_at).toLocaleString() }}
			</td>
			<td class="p-2 border-b text-center">
				<a class="inline-block rounded border-blue-200 border py-2 w-12 text-center hover:bg-blue-100 hover:text-blue-500"
					href="javascript:alert('TODO: toggle el estado')">{{request.is_managed==='1' ? 'Sí' : 'No' }}</a>
			</td>
			<td class="p-2 border-b whitespace-nowrap">
				<a target="_blank" class="inline-block rounded border-blue-200 border p-2 hover:bg-blue-100 hover:text-blue-500" :href="pdf(request.id)">Descargar PDF</a>
			</td>
		</tr>
	</table>
</div>

</template>

<script>
    export default {
		data() {
			return {
				sort_order: 'id',
				sort_direction: 'desc',
				requests: [],
				query: '',
			}
		},
        mounted() {
			this.load();
        },
		methods: {
			toggle_sort(sort_order) {
				this.sort_order = sort_order;
				this.sort_direction = this.sort_direction === 'asc' ? 'desc' : 'asc',
				this.load();
			},

			toggle_is_managed(record_id) {
				alert(`/api/requests/${record_id}`);

				axios.get(`/api/requests/${record_id}`)
				.then(response => {
					console.log();
				})
				.catch(error => {
					alert(error.message);
				});
			},
			load() {
				axios.get(`/api/requests?order=${this.sort_order}&direction=${this.sort_direction}`)
					.then(response => {
						this.requests = response.data;
					})
					.catch( error => {
						console.log(error.message)
					});
			},
			search(event) {
				console.log(this.query.length);
				if (!this.query.length) {
					this.load();
					return;
				}
				if (this.query.length > 2) {
					axios.get(`/api/requests?search=${this.query}`)
						.then(response => {
							this.requests = response.data;
						}).catch(error => {
							alert(error.message);
						})
				}
			},
			pdf(id) {
				return `/download/${id}`;
			}
		}
    }
</script>