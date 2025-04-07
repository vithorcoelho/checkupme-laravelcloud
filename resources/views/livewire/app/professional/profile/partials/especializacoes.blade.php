<div class="grid grid-cols-1 gap-x-6 gap-y-12 sm:grid-cols-4">
    <div>
        <h2 class="text-base/7 font-semibold text-gray-900">Especialidades</h2>
        <p class="mt-1 text-sm/6 text-gray-600">Pacientes podem buscar especialistas em áreas específicas na plataforma
        </p>
    </div>

    <div class="bg-white shadow-xs rounded-lg px-6 py-8 col-span-3 w-full">
        <div x-data="especialidadesComponent()" x-init="init()">
            <template x-for="(specialty, index) in specialties" :key="index">

                <div class="mb-4">
                    <label class="block text-sm/6 font-medium text-gray-900 mb-2">Especialidade</label>
                    <div class="flex items-center gap-2 mb-2">
                        <select x-model="specialties[index].id"
                            class="block w-full rounded-md bg-white px-2 py-2 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                            <option value="">Selecione uma especialidade</option>
                            <template x-for="option in filteredOptions(index)" :key="option . id">
                                <option :value="option . id" :selected="option . id == specialty . id"
                                    x-text="option.name">
                                </option>
                            </template>
                        </select>
                        <button type="button" @click="removeSpecialty(index)" class="hover:bg-gray-100 rounded p-1">
                            <flux:icon.x-mark />
                        </button>
                    </div>
                </div>
            </template>
            <div class="">
                <button type="button" @click="addSpecialty()" class=" float-left inline-flex items-center justify-center text-sm font-semibold rounded-md bg-white px-3 py-2 hover:bg-gray-100 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 text-green-700">
                    <flux:icon.plus />
                    <span class="ml-2">Adicionar Especialidade</span>
                </button>

                <button type="button" @click="$wire.set('selectedSpecialties', specialties)" wire:click="saveSpecialties"
                    wire:loading.attr="disabled" wire:loading.class="opacity-50 cursor-not-allowed"
                    class="float-right rounded-md bg-indigo-600 mt-4 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Salvar
                </button>
            </div>
        </div>

        <script>
            function especialidadesComponent() {
                return {
                    specialties: [],
                    availableSpecialties: @json($availableSpecialties),
                    init() {
                        this.specialties = @json($selectedSpecialties).map(s => ({ id: s.id }));
                    },
                    addSpecialty() {
                        this.specialties.push({ id: '' });
                    },
                    removeSpecialty(index) {
                        this.specialties.splice(index, 1);
                    },
                    filteredOptions(index) {
                        return this.availableSpecialties.filter(o =>
                            !this.specialties.some((s, i) => i !== index && s.id == o.id)
                        );
                    }
                };
            }
        </script>
    </div>
</div>
