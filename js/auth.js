
// Autenticación simple con sesiones via PHP
export async function login(usuario, contrasena){
  const res = await fetch('api/login.php', {
    method:'POST',
    headers:{'Content-Type':'application/json'},
    body: JSON.stringify({usuario, contrasena})
  });
  if(!res.ok) throw new Error('Error en login');
  return await res.json();
}
export async function logout(){
  await fetch('api/logout.php', {method:'POST'});
  window.location.href = 'login.html';
}
export async function requireAuth(){
  const res = await fetch('api/session.php');
  if(!res.ok){ window.location.href='login.html'; return null; }
  const data = await res.json();
  if(!data.auth) window.location.href='login.html';
  return data;
}
export function toast(msg){
  alert(msg);
}
