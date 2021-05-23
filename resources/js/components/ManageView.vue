<template>

<div class="container  mx-auto py-2">
		<div class="bg-white border-t border-b flex items-center justify-between">
			<input type="search" v-model="query"
				placeholder="Buscar..."
				v-on:keyup="search"
				class="w-full text-left p-4 flex-1 focus:outline-none">
				<i class="fas fa-search px-4"></i>
		</div>
	<table class="bg-white w-full">
		<thead class="">
			<tr class="cursor-pointer whitespace-nowrap text-sm text-left font-semibold border-b">
				<th class="p-2"  @click="toggle_sort('id')">
					Id <i :class="sort_icon('id')"></i>
				</th>
				<th class="p-2" @click="toggle_sort('company_name')">
					Empresa <i :class="sort_icon('company_name')"></i>
				</th>
				<th class="p-2 text-right" @click="toggle_sort('annual_income')">
					Ingresos anuales <i :class="sort_icon('annual_income')"></i>
				</th>
				<th class="p-2" @click="toggle_sort('contact_name')">
					Contacto <i :class="sort_icon('contact_name')"></i>
				</th>
				<th class="p-2" @click="toggle_sort('created_at')">
					Fecha <i :class="sort_icon('created_at')"></i>
				</th>
				<th class="p-2">Gestionado</th>
				<th class="p-2"></th>
			</tr>
		</thead>
		<tbody>
		<tr v-for="request in requests" :key="request.id" class="align-top border-b">
			<td class="p-2">{{request.id}}#</td>
			<td class="p-2">{{request.company_name}}</td>
			<td class="p-2 text-right">{{request.annual_income}}</td>
			<td class="p-2">
				<div class="font-semibold">{{request.contact_name}}</div>
				<div class="text-sm">{{request.contact_email}}</div>
				<div class="text-sm">{{request.contact_phone}}</div>
			</td>
			<td class="p-2">
				{{ new Date(request.created_at).toLocaleString() }}
			</td>
			<td class="text-center text-sm p-2 w-10">
				<button
					class="inline-block rounded border-blue-200 border p-1 w-12 text-center hover:bg-indigo-100 hover:text-indigo-500"
					@click="toggle_status(request.id, request.is_managed)">
					{{request.is_managed==='1' ? 'Sí' : 'No' }}
				</button>
			</td>
			<td class="pr-2 whitespace-nowrap text-right text-sm p-2 w-10">
				<a target="_blank" class="inline-block rounded border-blue-200 border p-1 hover:bg-indigo-100 hover:text-indigo-500"
					:href="pdf(request.id)">
					Descargar PDF
				</a>
			</td>
		</tr>
		</tbody>
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

			toggle_status(record_id, is_managed) {
				const url = `/api/requests/${record_id}`;

				is_managed = (is_managed==='1')
					? '0'
					: '1';

				axios.put(`/api/requests/${record_id}`, {
					is_managed
				})
				.then(response => {
					this.load();
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
			},

			sort_icon(sort_order) {
				const icon = {
					sort:'fas fa-sort text-gray-300',
					asc: 'fas fa-sort-alpha-up-alt text-gray-800',
					desc:'fas fa-sort-alpha-down-alt text-gray-800',
				}
				if (this.sort_order!==sort_order) {
					return icon.sort;
				}

				return icon[this.sort_direction];
			}
		},

    }
</script>

<style>
	.isActive {background-color: yellow;}
</style>