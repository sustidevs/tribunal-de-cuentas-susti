export default function guest({ next, store }) {
    if (!(store.getters.get_user.area === 'DPTO. MESA DE ENTRADAS Y SALIDAS')) {
        return next({
            name: 'Home'
        })
    } else {
        next();
    }
}