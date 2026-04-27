<div class="container-xxl grow container-p-y">
    <form class="labassay-form" method="POST" autocomplete="off">
        <div class="row justify-content-center">
            <div class="col-9">
                <div class="card">
                    <div class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
                        <h5 class="card-title mb-sm-0 me-2">LABORATORY ASSAY</h5>
                        <input type="hidden" name="trans_type" id="trans_type" value="New">
                    </div>

                    <div class="card-body pt-12">
                        <div class="row">
                            <div class="col-lg-12 mx-auto">
                                <div class="row g-6">
                                    <div class="col-md-2">
                                        <label class="form-label" for="assaycode">Code</label>
                                        <input type="text" id="assaycode" class="form-control" disabled />
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label" for="abbreviation">Abbreviation</label>
                                        <input type="text" id="abbreviation" class="form-control" required />
                                    </div>

                                    <div class="col-md-8">
                                        <label class="form-label" for="description">Description</label>
                                        <input type="text" id="description" class="form-control" required />
                                    </div>
                                </div>

                                <br>

                                <div class="row g-6">
                                    <div class="col-md-5">
                                        <label for="category" class="form-label">Category</label>
                                        <select id="category" class="select2 form-select" data-allow-clear="true" required>
                                            <option></option>
                                            <option value="Clinical Chemistry">Clinical Chemistry</option>
                                            <option value="Endocrinology">Endocrinology</option>
                                            <option value="Hematology">Hematology</option>
                                            <option value="Microbiology">Microbiology</option>
                                            <option value="Microsopy">Microsopy</option>
                                            <option value="Serology">Serology</option>
                                        </select>
                                    </div>

                                    <div class="col-md-2">
                                        <label for="atype" class="form-label">Type</label>
                                        <select id="atype" class="select2 form-select" data-allow-clear="true" required>
                                            <option></option>
                                            <option value="Culture">Culture</option>
                                            <option value="Panel">Panel</option>
                                            <option value="Single">Single</option>
                                            <option value="Staining">Staining</option>
                                        </select>
                                    </div>

                                    <div class="col-md-2">
                                        <label for="resulttype" class="form-label">Result</label>
                                        <select id="resulttype" class="select2 form-select" data-allow-clear="true" required>
                                            <option></option>
                                            <option value="Granded">Granded</option>
                                            <option value="Numeric">Numeric</option>
                                            <option value="Panel">Panel</option>
                                            <option value="Text">Text</option>
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="specimen" class="form-label">Specimen</label>
                                        <select id="specimen" class="select2 form-select" data-allow-clear="true" required>
                                            <option></option>
                                            <option value="Blood">Blood</option>
                                            <option value="Sputum">Sputum</option>
                                            <option value="Sputum/Wound">Sputum/Wound</option>
                                            <option value="Stool">Stool</option>
                                            <option value="Urine">Urine</option>
                                            <option value="Variours">Variours</option>
                                        </select>
                                    </div>
                                </div>

                                <br>

                                <div class="row g-6">
                                    <div class="col-md-2">
                                        <label class="form-label" for="unit">Unit</label>
                                        <input type="text" id="unit" class="form-control" />
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label" for="price">Price</label>
                                        <input type="number" id="price" class="form-control" min="0" step="1" value="0" />
                                    </div>

                                    <div class="col-md-8">
                                        <label class="form-label" for="remarks">Remarks</label>
                                        <input type="text" id="remarks" class="form-control" />
                                    </div>
                                </div>

                                <div class="demo-inline-spacing">
                                    <button type="button" class="btn btn-outline-primary" id="btn-new">
                                        <span class="icon-xs icon-base ti tabler-file me-2"></span>New
                                    </button>
                                    <button type="button" class="btn btn-outline-success" id="btn-save">
                                        <span class="icon-xs icon-base ti tabler-device-floppy me-2"></span>Save
                                    </button>
                                    <button
                                        type="button"
                                        class="btn btn-outline-info"
                                        id="btn-search"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modal-search-assay">
                                        <span class="icon-xs icon-base ti tabler-search me-2"></span>Search
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<style>
    #modal-search-assay .labAssayListTable {
        border-collapse: collapse;
    }

    #modal-search-assay .labAssayListTable th,
    #modal-search-assay .labAssayListTable td {
        border: 1px solid rgba(255, 255, 255, 0.85) !important;
    }

    #modal-search-assay .labAssayListTable thead th {
        border-width: 2px !important;
    }

    #modal-search-assay .labAssayListTable tbody tr {
        cursor: pointer;
    }
</style>

<div class="modal fade" id="modal-search-assay" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalSearchAssayTitle">LABORATORY ASSAYS</h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <table class="table table-bordered table-hover labAssayListTable">
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th>Code</th>
                            <th>Category</th>
                            <th>Specimen</th>
                            <th>Price</th>
                            <th>ACT</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
