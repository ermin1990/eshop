## E-Shop Web Aplikacija

Dobrodošli u E-Shop Web Aplikaciju! Ovo je jednostavna web aplikacija izrađena koristeći PHP i MySQL, koja omogućava administratorima da upravljaju proizvodima, kreiraju akcije i pregledavaju narudžbe korisnika.

### Funkcionalnosti

- **Upravljanje Proizvodima:** Administratori mogu dodavati, uređivati i brisati proizvode. Svaki proizvod ima naziv, cijenu, veličinu i sliku.

- **Akcije:** Administratori mogu kreirati akcije za određene proizvode. Akcije mogu imati datum početka i završetka, i administratori mogu odabrati koji proizvodi će biti uključeni u svaku akciju.

- **Upravljanje Narudžbama:** Administratori mogu pregledavati sve narudžbe korisnika. Svaka narudžba uključuje detalje o naručenim proizvodima, ukupnu cijenu i informacije o korisniku.

- **Detalji Narudžbe:** Administratori mogu istražiti pojedinačne narudžbe kako bi vidjeli konkretne proizvode koji su naručeni, njihove cijene, količine i ukupne iznose.

### Početak Korištenja

1. Klonejte repozitorijum na vaš lokalni uređaj.
   ```bash
   git clone https://github.com/eshop/e-shop.git
   ```

2. Uvezite SQL fajl (`eshop.sql`) u vašu MySQL bazu podataka kako bi se kreirale potrebne tabele.

3. Konfigurišite konekciju sa bazom podataka tako što ćete ažurirati fajl `app/config/config.php` sa vašim podacima za bazu.

4. Pokrenite lokalni server, kao što je XAMPP ili WAMP, i otvorite projektni folder u vašem web pregledniku.

5. Kreirajte admin korisnika direktno u tabeli `users` u bazi podataka sa odgovarajućom ulogom (admin). To će vam omogućiti pristup administrativnim funkcionalnostima.

6. Prijavite se na aplikaciju koristeći admin pristupne podatke koje ste kreirali.

### Korištenje

- Idite na administratorsku sekciju kako biste upravljali proizvodima, kreirali akcije i pregledali narudžbe.

- Dodajte proizvode, postavite njihove cijene, veličine i slike.

- Kreirajte akcije i povežite ih sa određenim proizvodima.

- Istražite narudžbe kako biste vidjeli detalje o korisnicima i naručenim proizvodima.

### Doprinose

Doprinosi su dobrodošli! Ako primijetite bilo kakve probleme ili imate sugestije za poboljšanja, slobodno otvorite "issue" ili podnesite "pull request".


---

Uživajte koristeći E-Shop Web Aplikaciju! Ako imate bilo kakvih pitanja ili trebate dodatnu pomoć, slobodno se obratite.
