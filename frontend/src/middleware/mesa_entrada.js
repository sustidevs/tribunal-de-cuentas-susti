export default function guest({ next, store }) {
    if (!(store.getters.getArea === 'DPTO. MESA DE ENTRADAS Y SALIDAS')) {
        return next({
            name: 'Home'
        })
    } else {
        next();
    }
}