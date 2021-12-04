export default function guest({ next, store }) {
    if (store.getters.getIdUser > 0) {
        next("/")
    } else {
        next();
    }
}