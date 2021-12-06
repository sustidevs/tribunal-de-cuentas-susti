export default function auth({ next, store }) {
    if (!(store.getters.authenticated)) {
        next("/login")
    } else {
        next();
    }
}