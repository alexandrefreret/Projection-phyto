<template>
	<div>
		<DefaultSelect :lists="cultures" label="Cultures" name="cultures" v-model="firstOption"></DefaultSelect>
		<div class="row">
			<div class="col-md-6">
				<DefaultSelect :lists="fonctions" label="Fonctions" name="fonctions" v-model="secondOption"></DefaultSelect>
			</div>
			<div class="col-md-6">
				<DefaultSelect :lists="substances" label="Substances" name="substances" v-model="thirdOption"></DefaultSelect>
			</div>
		</div>

		<div class="row" v-if="secondOption == 'Fongicide' || secondOption == 'Insecticide'">
			<div class="col-md-12">
				<DefaultSelect :lists="maladies" label="Maladies" name="maladies" v-model="fourthOption"></DefaultSelect>
			</div>
		</div>
		
		<DefaultSelect :lists="produits" label="produits" name="produits" v-model="fifthOption"></DefaultSelect>
		<!-- <DefaultSelect :lists="produits" label="Produits" name="produits" v-model="secondOption" :parent="firstOption"></DefaultSelect> -->

	</div>
</template>

<script>
	import DefaultSelect from './DefaultSelect'
	import axios from 'axios';

	export default {
		components: {
			DefaultSelect
		},
		data: function (){
			return { 
				cultures: [],
				produits: [],
				fonctions: [],
				substances: [],
				maladies: [],
				combinaisons: [],
				tmp_produits_cultures: [],
				firstOption: null,
				secondOption: null,
				thirdOption: null,
				fourthOption: null,
				fifthOption: null,
			}
		},
		mounted () {
			var self = this;

			//Récupération des cultures
			axios.get('/api/cultures').then(function(response){
				let data = response.data;
				self.cultures = data.data;
			})


			axios.get('/api/fonctions').then(function(response){
				let data = response.data;
				self.fonctions = data.data;
			})

			axios.get('/api/substances').then(function(response){
				let data = response.data;
				self.substances = data.data;
			})

			axios.get('/api/usages').then(function(response){
				let data = response.data;
				self.maladies = data.data;
			})

			axios.get('/api/combinaisons').then(function(response){
				let data = response.data;
				self.combinaisons = data;
			})
		},
		watch: {
			firstOption: function (val) {
				this.produits = this.combinaisons['cultures'][val];
				this.tmp_produits_cultures = this.combinaisons['cultures'][val];
			},
			secondOption: function(val){
				let produits_cultures = this.tmp_produits_cultures;

				let produits_fonctions = this.combinaisons['fonctions'][val];
				
				this.produits = this._.intersectionBy(produits_cultures,produits_fonctions, 'label');
				console.log(this.produits);

			}
		},
		methods: {
			intersection: function(a, b) {

				return result;
			}
		}

	}
</script>