<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DangerButton from '@/Components/DangerButton.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import Swal from 'sweetalert2';
import axios from 'axios';



const props = defineProps({
    empleados: {type:Object},
    tareas: {type: Object}
})
const form = useForm({
    id: props.tareas.id,
    descripcion: props.tareas.descripcion,
    estado: props.tareas.estado,
    empleado_id: props.tareas.empleado_id
    
})
const tareas = ref(props.tareas);

const ordenarPorEstado = () => {
    tareas.value.sort((a, b) => {
        return a.estado.localeCompare(b.estado);
    });
};

const ordenarPorEmpleado = () => {
    tareas.value.sort((a, b) => {
        return a.empleado_id - b.empleado_id;
    });
};

const eliminarTarea = (id) => {
    const alerta = Swal.mixin({
        buttonStyling: true
    });
    alerta.fire({
        title: 'Desea borrar la tarea ?',
        icon:'question', showCancelButton:true,
        confirmButtonText:'<i class="fa-solid fa-check"></i> Si, eliminar',
        cancelButtonText:'<i class="fa-solid fa-ban"></i> Cancelar'
    }).then((result) => {
        if(result.isConfirmed){ 
            form.delete(route('tareas.destroy', id))
            console.log('Tarea eliminada', id)
        }
    })
    .catch((error) => {
        console.error("Error al eliminar tarea: ", error);
    });
}

</script>

<template>
    <Head title="Tareas" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tareas</h2>
        </template>

        <div class="py-12">
            <div class="bg-white grid v-screen place-items-center">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="mt-3 mb-3 flex">
                        <Link :href="route('tareas.create')" 
                        :class="'px-4 py-2 bg-gray-800 text-white border rounded-md font-semibold text-xs'">
                            <i class="fa-solid fa-plus-circle "> Agregar</i> 
                        </Link>                    
                    </div>
                </div>
                <div class="bg-white grid v-screen place-items-center">
                    <table class="table-auto border border-gray-400">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-4">#</th>
                                <th class="px-4 py-4">Tarea</th>
                                <th class="px-4 py-4" @click="ordenarPorEstado()">Estado <i class="fas fa-arrow-up"></i> </th>
                                <th class="px-4 py-4" @click="ordenarPorEmpleado()"># Empleado <i class="fas fa-arrow-up"></i> </th>
                                <th class="px-4 py-4"></th>
                                <th class="px-4 py-4"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="tar, i in tareas" :key="tar.id">
                            <td class="border border-gray-400 px-4 py-4">{{ tar.id }}</td>
                            <td class="border border-gray-400 px-4 py-4">{{ tar.titulo }}</td>
                            <td class="border border-gray-400 px-4 py-4">{{ tar.estado }}</td>
                            <td class="border border-gray-400 px-4 py-4 text-center">{{ tar.empleado_id }}</td>
                            <td class="border border-gray-400 px-4 py-4">
                        <Link :href="route('tareas.edit', tar.id)" 
                              :class="'px-4 py-2 bg-yellow-500 text-white border rounded-md font-semibold text-xs'">
                                <i class="fa-solid fa-edit"></i> 
                        </Link> 
                            </td>
                            <td class="border border-gray-400 px-4 py-4">
                                <DangerButton @click="$event => eliminarTarea(tar.id)">
                                 <i class="fa-solid fa-trash"></i> 
                                    </DangerButton>
                            </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
