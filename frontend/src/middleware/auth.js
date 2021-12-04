export default function auth({ next, store }) {
    if (!(store.getters.getIdUser > 0)) {
        next("/login")
    } else {
        next();
    }
}