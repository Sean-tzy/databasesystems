<div class="container-xxl grow container-p-y">
    <form class="patient-form" method="POST" autocomplete="nope">
        <div class="row justify-content-center">
            <div class="col-9">
                <div class="card">
                <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
                    <h5 class="card-title mb-sm-0 me-2">PATIENT REGISTRY</h5>
                    <input type="hidden" name="encodedby" id="encodedby" value="<?php echo $_SESSION["empid"];?>">
                    <input type="hidden" name="trans_type" id="trans_type" value="New">
                </div>
                <div class="card-body pt-12">
                    <div class="row">
                        <div class="col-lg-12 mx-auto">
                            <div class="row g-6">
                                <div class="col-md-4">
                                    <label class="form-label" for="firstname">First name</label>
                                    <input type="text" id="firstname" class="form-control" required/>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label" for="lastname">Last name</label>
                                    <input type="text" id="lastname" class="form-control" required/>
                                </div>
                                <div class="col-md-1">
                                    <label class="form-label" for="mi">MI</label>
                                    <input type="text" id="mi" class="form-control" required/>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label" for="extension">Extension</label>
                                    <input type="text" id="extension" class="form-control"/>
                                </div>
                            </div>
                            <br>                    
                            <div class="row g-6">
                                <div class="col-md-2">
                                    <label class="form-label" for="birthdate">Date of Birth</label>
                                    <input type="text" id="birthdate" class="form-control" />
                                </div>
                                <div class="col-md-1">
                                    <label class="form-label" for="age">Age</label>
                                    <input type="text" id="age" class="form-control" disabled/>
                                </div>

                                <div class="col-md-2">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select id="gender" class="select2 form-select" data-allow-clear="true" required>
                                        <option></option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <label for="nationality" class="form-label">Nationality</label>
                                    <select id="nationality" class="select2 form-select" data-allow-clear="true" required>
                                        <option></option>
                                        <option value="Afghan">Afghan</option>
                                        <option value="Albanian">Albanian</option>
                                        <option value="Algerian">Algerian</option>
                                        <option value="American">American</option>
                                        <option value="Andorran">Andorran</option>
                                        <option value="Angolan">Angolan</option>
                                        <option value="Argentine">Argentine</option>
                                        <option value="Armenian">Armenian</option>
                                        <option value="Australian">Australian</option>
                                        <option value="Austrian">Austrian</option>
                                        <option value="Azerbaijani">Azerbaijani</option>
                                        <option value="Bahamian">Bahamian</option>
                                        <option value="Bahraini">Bahraini</option>
                                        <option value="Bangladeshi">Bangladeshi</option>
                                        <option value="Barbadian">Barbadian</option>
                                        <option value="Belarusian">Belarusian</option>
                                        <option value="Belgian">Belgian</option>
                                        <option value="Belizean">Belizean</option>
                                        <option value="Beninese">Beninese</option>
                                        <option value="Bhutanese">Bhutanese</option>
                                        <option value="Bolivian">Bolivian</option>
                                        <option value="Bosnian">Bosnian</option>
                                        <option value="Botswanan">Botswanan</option>
                                        <option value="Brazilian">Brazilian</option>
                                        <option value="British">British</option>
                                        <option value="Bruneian">Bruneian</option>
                                        <option value="Bulgarian">Bulgarian</option>
                                        <option value="Burkinabe">Burkinabe</option>
                                        <option value="Burmese">Burmese</option>
                                        <option value="Burundian">Burundian</option>
                                        <option value="Cambodian">Cambodian</option>
                                        <option value="Cameroonian">Cameroonian</option>
                                        <option value="Canadian">Canadian</option>
                                        <option value="Cape Verdean">Cape Verdean</option>
                                        <option value="Central African">Central African</option>
                                        <option value="Chadian">Chadian</option>
                                        <option value="Chilean">Chilean</option>
                                        <option value="Chinese">Chinese</option>
                                        <option value="Colombian">Colombian</option>
                                        <option value="Comorian">Comorian</option>
                                        <option value="Congolese">Congolese</option>
                                        <option value="Costa Rican">Costa Rican</option>
                                        <option value="Croatian">Croatian</option>
                                        <option value="Cuban">Cuban</option>
                                        <option value="Cypriot">Cypriot</option>
                                        <option value="Czech">Czech</option>
                                        <option value="Danish">Danish</option>
                                        <option value="Djiboutian">Djiboutian</option>
                                        <option value="Dominican">Dominican</option>
                                        <option value="Dutch">Dutch</option>
                                        <option value="East Timorese">East Timorese</option>
                                        <option value="Ecuadorian">Ecuadorian</option>
                                        <option value="Egyptian">Egyptian</option>
                                        <option value="Emirati">Emirati</option>
                                        <option value="English">English</option>
                                        <option value="Eritrean">Eritrean</option>
                                        <option value="Estonian">Estonian</option>
                                        <option value="Ethiopian">Ethiopian</option>
                                        <option value="Fijian">Fijian</option>
                                        <option value="Filipino" selected>Filipino</option>
                                        <option value="Finnish">Finnish</option>
                                        <option value="French">French</option>
                                        <option value="Gabonese">Gabonese</option>
                                        <option value="Gambian">Gambian</option>
                                        <option value="Georgian">Georgian</option>
                                        <option value="German">German</option>
                                        <option value="Ghanaian">Ghanaian</option>
                                        <option value="Greek">Greek</option>
                                        <option value="Grenadian">Grenadian</option>
                                        <option value="Guatemalan">Guatemalan</option>
                                        <option value="Guinean">Guinean</option>
                                        <option value="Haitian">Haitian</option>
                                        <option value="Honduran">Honduran</option>
                                        <option value="Hungarian">Hungarian</option>
                                        <option value="Icelandic">Icelandic</option>
                                        <option value="Indian">Indian</option>
                                        <option value="Indonesian">Indonesian</option>
                                        <option value="Iranian">Iranian</option>
                                        <option value="Iraqi">Iraqi</option>
                                        <option value="Irish">Irish</option>
                                        <option value="Israeli">Israeli</option>
                                        <option value="Italian">Italian</option>
                                        <option value="Jamaican">Jamaican</option>
                                        <option value="Japanese">Japanese</option>
                                        <option value="Jordanian">Jordanian</option>
                                        <option value="Kazakh">Kazakh</option>
                                        <option value="Kenyan">Kenyan</option>
                                        <option value="Kuwaiti">Kuwaiti</option>
                                        <option value="Kyrgyz">Kyrgyz</option>
                                        <option value="Laotian">Laotian</option>
                                        <option value="Latvian">Latvian</option>
                                        <option value="Lebanese">Lebanese</option>
                                        <option value="Liberian">Liberian</option>
                                        <option value="Libyan">Libyan</option>
                                        <option value="Lithuanian">Lithuanian</option>
                                        <option value="Luxembourgish">Luxembourgish</option>
                                        <option value="Malagasy">Malagasy</option>
                                        <option value="Malawian">Malawian</option>
                                        <option value="Malaysian">Malaysian</option>
                                        <option value="Maldivian">Maldivian</option>
                                        <option value="Malian">Malian</option>
                                        <option value="Maltese">Maltese</option>
                                        <option value="Mauritanian">Mauritanian</option>
                                        <option value="Mauritian">Mauritian</option>
                                        <option value="Mexican">Mexican</option>
                                        <option value="Moldovan">Moldovan</option>
                                        <option value="Monacan">Monacan</option>
                                        <option value="Mongolian">Mongolian</option>
                                        <option value="Montenegrin">Montenegrin</option>
                                        <option value="Moroccan">Moroccan</option>
                                        <option value="Mozambican">Mozambican</option>
                                        <option value="Namibian">Namibian</option>
                                        <option value="Nepalese">Nepalese</option>
                                        <option value="New Zealander">New Zealander</option>
                                        <option value="Nicaraguan">Nicaraguan</option>
                                        <option value="Nigerian">Nigerian</option>
                                        <option value="Norwegian">Norwegian</option>
                                        <option value="Omani">Omani</option>
                                        <option value="Pakistani">Pakistani</option>
                                        <option value="Panamanian">Panamanian</option>
                                        <option value="Papua New Guinean">Papua New Guinean</option>
                                        <option value="Paraguayan">Paraguayan</option>
                                        <option value="Peruvian">Peruvian</option>
                                        <option value="Polish">Polish</option>
                                        <option value="Portuguese">Portuguese</option>
                                        <option value="Qatari">Qatari</option>
                                        <option value="Romanian">Romanian</option>
                                        <option value="Russian">Russian</option>
                                        <option value="Rwandan">Rwandan</option>
                                        <option value="Saudi">Saudi</option>
                                        <option value="Scottish">Scottish</option>
                                        <option value="Senegalese">Senegalese</option>
                                        <option value="Serbian">Serbian</option>
                                        <option value="Singaporean">Singaporean</option>
                                        <option value="Slovak">Slovak</option>
                                        <option value="Slovenian">Slovenian</option>
                                        <option value="Somali">Somali</option>
                                        <option value="South African">South African</option>
                                        <option value="South Korean">South Korean</option>
                                        <option value="Spanish">Spanish</option>
                                        <option value="Sri Lankan">Sri Lankan</option>
                                        <option value="Sudanese">Sudanese</option>
                                        <option value="Swedish">Swedish</option>
                                        <option value="Swiss">Swiss</option>
                                        <option value="Syrian">Syrian</option>
                                        <option value="Taiwanese">Taiwanese</option>
                                        <option value="Tanzanian">Tanzanian</option>
                                        <option value="Thai">Thai</option>
                                        <option value="Tunisian">Tunisian</option>
                                        <option value="Turkish">Turkish</option>
                                        <option value="Ugandan">Ugandan</option>
                                        <option value="Ukrainian">Ukrainian</option>
                                        <option value="Uruguayan">Uruguayan</option>
                                        <option value="Uzbek">Uzbek</option>
                                        <option value="Venezuelan">Venezuelan</option>
                                        <option value="Vietnamese">Vietnamese</option>
                                        <option value="Welsh">Welsh</option>
                                        <option value="Yemeni">Yemeni</option>
                                        <option value="Zambian">Zambian</option>
                                        <option value="Zimbabwean">Zimbabwean</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label" for="email">Email Address</label>
                                    <input type="text" id="email" class="form-control"/>
                                </div>
                            </div>
                            <br>
                            <div class="row g-6">
                                <div class="col-md-4">
                                    <label class="form-label" for="mobile">Mobile Number</label>
                                    <input type="text" id="mobile" class="form-control"/>
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label" for="alternate">Alternate Contact</label>
                                    <input type="text" id="alternate" class="form-control"/>
                                </div>
                            </div>
                            <br>
                            <div class="col-12">
                                <label class="form-label" for="address">Address</label>
                                <textarea
                                name="address"
                                class="form-control"
                                id="address"
                                rows="2"></textarea>
                            </div>

                            <div class="demo-inline-spacing">
                                <button type="button" class="btn btn-outline-primary" id="btn-new">
                                    <span class="icon-xs icon-base ti tabler-file me-2"></span>New
                                </button>
                                <button type="button" class="btn btn-outline-success" id="btn-save">
                                    <span class="icon-xs icon-base ti tabler-star me-2"></span>Save
                                </button>
                                <button type="button" 
                                    class="btn btn-outline-info" 
                                    id="btn-search"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#modal-search-patient">
                                    <span class="icon-xs icon-base ti tabler-search me-2"></span>Search
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="modal fade" id="modal-search-patient" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">PATIENT LIST</h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <div class="modal-body">
                        <table class="table table-bordered table-hover patientListTable">
                            <thead>
                                <tr>
                                    <th>Patient ID</th>
                                    <th>Lastname</th>
                                    <th>Firstname</th>
                                    <th>MI</th>
                                    <th>Address</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">

                            </tbody>
                        </table>
            </div>
        </div>
    </div>
</div>