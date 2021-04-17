import DefaultTemplate from "../layouts/DefaultTemplate";
import Home from '../views/Home'
import Person from "../views/Person";

const routes = [
    {
        path: '/', component: DefaultTemplate,
        children: [
            {path: '', name: 'index', component: Home},
            {path: 'person/:id', name: 'person', component: Person}
        ],
    },
]

export default routes
