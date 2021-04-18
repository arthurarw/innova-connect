import DefaultTemplate from "../layouts/DefaultTemplate";
import Home from '../views/Home'
import Person from "../views/Person";

const routes = [
    {
        path: '/', component: DefaultTemplate,
        children: [
            {path: '', name: 'index', component: Home},
            {path: 'person/:id', name: 'person-edit', component: Person},
            {path: 'person/create', name: 'person-create', component: Person}
        ],
    },
]

export default routes
