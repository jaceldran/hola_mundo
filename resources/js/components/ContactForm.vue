<template>
<div>
	<form method="post"  @submit.prevent="submit" class="container mx-auto p-4">

		<input type="hidden" v-model="record.is_managed">

		<section class="grid md:grid-cols-2 gap-4">
			<p>
				<label class="block text-gray-600">
					¿Cómo se llama tu empresa?
					<input required type="text" v-model="record.company_name" placeholder="¿Cómo se llama tu empresa?" class="p-2 border w-full"/>
				</label>
			</p>

			<p>
				<label class="block text-gray-600">
					¿Cuáles son los ingresos anuales?
					<input required type="number" v-model="record.annual_income" step="any" placeholder="¿Cuáles son los ingresos anuales?" class="p-2 border w-full"/>
				</label>
			</p>

			<p>
				<label class="block text-gray-600">
					¿Cómo te llamas tú?
					<input required type="text" v-model="record.contact_name" placeholder="¿Cómo te llamas tú?" class="p-2 border w-full"/>
				</label>
			</p>

			<p>
				<label class="block text-gray-600">
					Teléfono de contacto
					<input required type="tel" v-model="record.contact_phone" placeholder="Teléfono de contacto" class="p-2 border w-full"/>
				</label>
			</p>

			<p>
				<label class="block text-gray-600">
					Email de contacto
					<input required type="tel" v-model="record.contact_email" placeholder="Email de contacto" class="p-2 border w-full"/>
				</label>
			</p>

			<p>
				<label class="block text-gray-600">
					Qué te interesa de nosotros
					<textarea required v-model="record.message" placeholder="Qué te interesa de nosotros" class="p-2 border w-full"></textarea>
				</label>
			</p>

		</section>

		<section v-if="!is_manage">
			<p class="my-8 text-center">
				<input required type="checkbox" v-model="record.legal_terms" value="1" id="input_legal_terms">
				<a class="underline text-indigo-500" href="javascript:alert('Enlace a documento legal')">Acepto los términos legales</a>
			</p>

			<p>
				<button v-show="!button_disabled"
					class="block cursor-pointer p-4 w-2/3 mt-8 mx-auto rounded-full bg-indigo-500 text-white uppercase font-semibold" type="submit">
					{{button_text}}
				</button>
				<button v-show="button_disabled"
					disabled
					class="block cursor-pointer p-4 w-2/3 mt-8 mx-auto rounded-full bg-gray-300 text-white uppercase font-semibold" type="submit">
					{{button_text}}
				</button>
			</p>
		</section>
		<section v-else>
			<hr>
			<label>
				<input required type="checkbox" v-model="record.is_managed" value="1" id="input_is_managed">
				Gestionado
			</label>
			<p>Descargar PDF</p>
		</section>
	</form>
</div>

</template>

<script>
    export default {

		data() {
			return {
				record: {
					company_name: '',
					annual_income: 0,
					contact_name: '',
					contact_phone: '',
					contact_email: '',
					message: '',
					legal_terms: true,
				},
				button_text: 'Enviar',
				button_disabled: false,
				button_style: 'bg-gray-500',
				is_edit: true,
			}
		},
        mounted() {
			//alert(this.test + ' ' + this.is_manage);
        },
		methods: {
			submit() {
				const params = this.record;
				this.button_disabled = true;
				this.button_text = 'E n v i a n d o...';
				axios.post('/api/requests', params)
				.then((response) => {
					this.button_disabled = false;
					this.button_text = 'Enviar';
					alert(`Solicitud recibida OK\nSe ha enviado notificación a ${this.record.contact_email}`);
				}).catch(error => {
					this.button_disabled = false;
					this.button_text = 'Enviar';
					alert(error.message)
				});
			},
		}
    }
</script>