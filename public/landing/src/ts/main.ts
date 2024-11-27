import '../scss/main.scss'

import { setupCounter } from './modules/counter.ts'

document.querySelector<HTMLDivElement>('#app')!.innerHTML = ``

setupCounter(document.querySelector<HTMLButtonElement>('#counter')!)
