
import {toast} from './auth.js';

const tableBody = () => document.querySelector('#tb-especialistas');
const form = () => document.querySelector('#frm-especialista');
const dlg = () => document.querySelector('#modal');
const dlgTitle = () => document.querySelector('#modalTitle');
const btnNew = () => document.querySelector('#btnNew');

async function listar(){
  const res = await fetch('api/especialistas.php');
  const data = await res.json();
  render(data);
}
function render(list){
  const tb = tableBody();
  tb.innerHTML = '';
  list.forEach(row => {
    const tr = document.createElement('tr');
    tr.innerHTML = `
      <td>${row.id}</td>
      <td>${row.nombre}</td>
      <td>${row.especialidad}</td>
      <td>${row.horario}</td>
      <td>${row.contacto}</td>
      <td class="actions">
        <button class="btn" data-edit="${row.id}">Editar</button>
        <button class="btn secondary" data-del="${row.id}">Eliminar</button>
      </td>`;
    tb.appendChild(tr);
  });
}
function openModal(title, data={}){
  dlgTitle().textContent = title;
  const f = form();
  f.reset();
  f.id.value = data.id || '';
  f.nombre.value = data.nombre || '';
  f.especialidad.value = data.especialidad || '';
  f.horario.value = data.horario || '';
  f.contacto.value = data.contacto || '';
  dlg().classList.add('open');
}
function closeModal(){ dlg().classList.remove('open'); }

document.addEventListener('click', async (e)=>{
  if(e.target.matches('#btnNew')){
    openModal('Nuevo Especialista');
  }
  if(e.target.matches('[data-edit]')){
    const id = e.target.getAttribute('data-edit');
    const res = await fetch('api/especialistas.php?id='+id);
    const data = await res.json();
    openModal('Editar Especialista', data);
  }
  if(e.target.matches('[data-del]')){
    const id = e.target.getAttribute('data-del');
    if(confirm('¿Eliminar registro '+id+'?')){
      const res = await fetch('api/especialistas.php?id='+id, {method:'DELETE'});
      const out = await res.json();
      toast(out.message||'Eliminado');
      listar();
    }
  }
  if(e.target.matches('[data-close]')) closeModal();
});

document.addEventListener('submit', async (e)=>{
  if(e.target.matches('#frm-especialista')){
    e.preventDefault();
    const data = Object.fromEntries(new FormData(form()).entries());
    const method = data.id ? 'PUT' : 'POST';
    const url = 'api/especialistas.php' + (data.id ? ('?id='+data.id) : '');
    const res = await fetch(url, {method, headers:{'Content-Type':'application/json'}, body: JSON.stringify(data)});
    const out = await res.json();
    toast(out.message||'Guardado');
    closeModal();
    listar();
  }
});

window.addEventListener('DOMContentLoaded', listar);
