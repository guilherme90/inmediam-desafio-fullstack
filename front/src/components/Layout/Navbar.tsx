export default function Navbar () {
  return (
    <nav className="bg-white">
      <div className="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
        <div className="relative flex h-16 items-center justify-between">
          <div className="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
            <div className="hidden sm:ml-6 sm:block">
              <div className="flex space-x-4">
                <a href="/" className="bg-orange-400 text-white rounded-md px-3 py-2 text-sm font-medium" aria-current="page">Home</a>
                <a href="/contracts" >Meus Contratos</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </nav>
  )
}
