import { Route, Routes } from 'react-router-dom'
import { Home } from './pages/Home'
import { Plan } from '@/pages/Plan'
import { Contracts } from '@/pages/Contracts'
import { Pay } from '@/pages/Contracts/Pay.tsx'

export function Router() {
  return (
    <Routes>
      <Route index path="/" element={<Home />} />
      <Route path="/plans/:id" element={<Plan />} />
      <Route path="/contracts" element={<Contracts />} />
      <Route path="/contracts/pay" element={<Pay />} />
    </Routes>
  )
}
