import { router } from '@inertiajs/vue3'

const goTo = (routeName, method = 'GET', data = false) => {
    if (method == 'POST') {
        router.post(route(routeName, data));
    } else if (method == 'PUT') {
        router.put(route(routeName, data));
    } else if (method == 'DELETE') {
        router.delete(route(routeName, data));
    } else {
        router.get(route(routeName, data));
    }
}

export default goTo