
import {requireAuth, logout, toast} from './auth.js';

window.addEventListener('DOMContentLoaded', async () => {
  const elUser = document.querySelector('[data-user]');
  const elLogout = document.querySelector('[data-logout]');
  if(elLogout) elLogout.addEventListener('click', (e)=>{ e.preventDefault(); logout(); });

  // proteger páginas (excepto login)
  if(!location.pathname.endsWith('login.html')){
    try {
      const session = await requireAuth();
      if(elUser && session?.user){ elUser.textContent = session.user.usuario; }
    } catch(e){
      console.error(e);
    }
  }
});
