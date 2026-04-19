@include('layouts.adminhead')

<body class="g-sidenav-show bg-gray-100">
  @include('layouts.aside')
  
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <!-- Navbar -->
    @include('layouts.navbar')
    <!-- End Navbar -->
    
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Bulk SMS Center</h6>
              </div>
            </div>
            
            <div class="card-body">
              <!-- Alerts -->
              @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
              @endif
              @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
              @endif

              <!-- Validation Errors -->
              @if ($errors->any())
                <div class="alert alert-danger">
                  <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              @endif

              <div class="row">
                <!-- LEFT SIDE: Send SMS + vCard Upload -->
                <div class="col-lg-5">
                  <!-- Upload vCard -->
                  <div class="card mb-4">
                    <div class="card-body">
                      <h6 class="mb-3">Contacts Management</h6>
                      <!-- Excel/CSV Upload -->
                      <div class="mb-4">
                        <p class="mb-2">Upload Contacts File (CSV / Excel)</p>
                        <form action="{{ route('vcard.upload') }}" method="POST" enctype="multipart/form-data">
                          @csrf
                          <div class="input-group input-group-outline mb-3">
                            <input type="file" name="vcard_file" accept=".csv, .xlsx" class="form-control" required>
                          </div>
                          <button type="submit" class="btn btn-primary w-100">
                            Upload Contacts
                          </button>
                        </form>
                      </div>

                      <!-- Add Single Contact Manually -->
                      <div class="mb-3">
                        <p class="mb-2">Add Single Contact</p>
                        <form action="{{ route('vcard.upload') }}" method="POST">
                          @csrf
                          <div class="row">
                            <div class="col-md-6 mb-3">
                              <div class="input-group input-group-outline">
                                <input type="text" name="full_name" class="form-control" placeholder="Full Name" required>
                              </div>
                            </div>
                            <div class="col-md-6 mb-3">
                              <div class="input-group input-group-outline">
                                <input type="text" name="phone_number" class="form-control" placeholder="Phone Number" required>
                              </div>
                            </div>
                            <div class="col-md-6 mb-3">
                              <div class="input-group input-group-outline">
                                <input type="email" name="email" class="form-control" placeholder="Email Address">
                              </div>
                            </div>
                            <div class="col-md-6 mb-3">
                              <div class="input-group input-group-outline">
                                <input type="text" name="organization" class="form-control" placeholder="Company">
                              </div>
                            </div>
                            <div class="col-12 mb-3">
                              <div class="input-group input-group-outline">
                                <input type="text" name="address" class="form-control" placeholder="Address">
                              </div>
                            </div>
                            <div class="col-12 mb-3">
                              <div class="input-group input-group-outline">
                                <input type="text" name="job_title" class="form-control" placeholder="Job Title">
                              </div>
                            </div>
                          </div>
                          <button type="submit" class="btn btn-success w-100">
                            Add Contact
                          </button>
                        </form>
                      </div>
                    </div>
                  </div>

                  <!-- Send Bulk SMS -->
                  <div class="card">
                    <div class="card-body">
                      <h6 class="mb-3">Send Bulk SMS</h6>

                      <form action="{{ route('sms.send.bulk') }}" method="POST" id="smsForm">
                        @csrf

                        <!-- Sender ID -->
                        <div class="mb-3">
                          <div class="input-group input-group-outline">
                            <input type="text" name="sender_id" class="form-control" maxlength="11" placeholder="Sender ID (max 11 chars)" value="KAUKAMEDICS" required>
                          </div>
                        </div>

                        <!-- Choose Mode -->
                        <div class="mb-3">
                          <p class="mb-2">Send SMS Mode</p>
                          <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="send_mode" id="manualMode" value="manual" checked>
                            <label class="form-check-label" for="manualMode">Manual Input</label>
                          </div>
                          <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="send_mode" id="importedMode" value="imported_all">
                            <label class="form-check-label" for="importedMode">Send to All Imported Contacts</label>
                          </div>
                          <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="send_mode" id="selectMode" value="select_contacts">
                            <label class="form-check-label" for="selectMode">Select from Imported Contacts</label>
                          </div>
                        </div>

                        <!-- Manual Input Section -->
                        <div id="manualSection">
                          <div class="row">
                            <div class="col-md-6 mb-3">
                              <div class="input-group input-group-outline">
                                <input type="text" name="full_name" class="form-control" placeholder="Full Name">
                              </div>
                            </div>
                            <div class="col-md-6 mb-3">
                              <div class="input-group input-group-outline">
                                <input type="text" name="phone_number" class="form-control" placeholder="Phone Number">
                              </div>
                            </div>
                            <div class="col-md-6 mb-3">
                              <div class="input-group input-group-outline">
                                <input type="email" name="email" class="form-control" placeholder="Email Address">
                              </div>
                            </div>
                            <div class="col-md-6 mb-3">
                              <div class="input-group input-group-outline">
                                <input type="text" name="organization" class="form-control" placeholder="Company">
                              </div>
                            </div>
                            <div class="col-12 mb-3">
                              <div class="input-group input-group-outline">
                                <input type="text" name="address" class="form-control" placeholder="Address">
                              </div>
                            </div>
                            <div class="col-12 mb-3">
                              <div class="input-group input-group-outline">
                                <input type="text" name="job_title" class="form-control" placeholder="Job Title">
                              </div>
                            </div>
                          </div>
                        </div>

                        <!-- Contact Selection Section -->
                        <div id="contactSelectionSection" class="d-none">
                          <div class="mb-3">
                            <p class="mb-2">Select Contacts <span class="badge bg-secondary">{{ $total }}</span></p>
                            
                            <!-- Search Box -->
                            <div class="input-group input-group-outline mb-3">
                              <input type="text" class="form-control" id="contactSearch" placeholder="Search contacts...">
                              <button class="btn btn-outline-secondary" type="button" id="clearSearch">
                                Clear
                              </button>
                            </div>

                            <!-- Contact Selection Panel -->
                            <div class="card">
                              <div class="card-header">
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" id="selectAllCheckbox">
                                  <label class="form-check-label" for="selectAllCheckbox">
                                    Select All on Page
                                  </label>
                                </div>
                                <small class="text-muted">
                                  <span id="visibleContacts">{{ count($contacts) }}</span> contacts shown
                                </small>
                              </div>
                              
                              <div class="card-body p-0" style="max-height: 250px; overflow-y: auto;">
                                <div id="contactsContainer">
                                  @foreach($contacts as $contact)
                                    <div class="p-3 border-bottom" data-contact-id="{{ $contact->id }}" 
                                         data-name="{{ strtolower($contact->full_name) }}"
                                         data-phone="{{ $contact->phone_number }}"
                                         data-email="{{ strtolower($contact->email) }}"
                                         data-company="{{ strtolower($contact->organization) }}">
                                      <div class="form-check mb-0">
                                        <input class="form-check-input contact-checkbox" type="checkbox" 
                                               name="selected_contacts[]" value="{{ $contact->id }}" 
                                               id="contact_{{ $contact->id }}" data-phone="{{ $contact->phone_number }}">
                                        <label class="form-check-label d-flex justify-content-between align-items-center" for="contact_{{ $contact->id }}">
                                          <div>
                                            <strong>{{ $contact->full_name }}</strong>
                                            <div class="text-muted small">
                                              {{ $contact->phone_number }}
                                              @if($contact->email)
                                                | {{ $contact->email }}
                                              @endif
                                            </div>
                                          </div>
                                          <div class="text-end">
                                            <small class="badge bg-light text-dark">
                                              {{ $contact->organization ?: 'No Company' }}
                                            </small>
                                          </div>
                                        </label>
                                      </div>
                                    </div>
                                  @endforeach
                                </div>
                              </div>
                            </div>

                            <!-- Selection Summary -->
                            <div class="mt-3">
                              <div class="d-flex justify-content-between align-items-center">
                                <div>
                                  <span class="badge bg-info">
                                    Selected: <span id="selectedCount">0</span> contacts
                                  </span>
                                </div>
                                <div class="btn-group btn-group-sm">
                                  <button type="button" class="btn btn-outline-success" id="selectAllBtn">
                                    Select All
                                  </button>
                                  <button type="button" class="btn btn-outline-danger" id="deselectAllBtn">
                                    Deselect All
                                  </button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <!-- Hidden fields -->
                        <input type="hidden" name="send_to_imported" value="0" id="sendToImported">
                        <input type="hidden" name="selected_phone_numbers" id="selectedPhoneNumbers">

                        <!-- Message -->
                        <div class="mb-3">
                          <div class="input-group input-group-outline">
                            <textarea name="message" rows="4" id="smsMessage" class="form-control" placeholder="Enter your SMS..." required></textarea>
                          </div>
                          <div class="d-flex justify-content-between mt-1">
                            <small class="text-muted">Characters: <span id="charCount">0</span></small>
                            <small class="text-muted">SMS Parts: <span id="smsParts">1</span></small>
                          </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                          Send SMS
                        </button>
                      </form>
                    </div>
                  </div>
                </div>

                <!-- RIGHT SIDE: Sent Messages Table -->
                <div class="col-lg-7">
                  <div class="card">
                    <div class="card-body">
                      <h6 class="mb-3">Sent Messages History</h6>

                      <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                          <thead>
                            <tr>
                              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">#</th>
                              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Number</th>
                              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Message</th>
                              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($messages as $msg)
                              <tr>
                                <td>
                                  <div class="d-flex px-2 py-1">
                                    <div class="d-flex flex-column justify-content-center">
                                      <h6 class="mb-0 text-sm">{{ $msg->id }}</h6>
                                    </div>
                                  </div>
                                </td>
                                <td>
                                  <p class="text-sm font-weight-bold mb-0">{{ $msg->receiver }}</p>
                                </td>
                                <td>
                                  <p class="text-sm mb-0" title="{{ $msg->message }}">
                                    {{ $msg->message }}
                                  </p>
                                </td>
                                <td>
                                  <span class="badge 
                                    @if($msg->status == 'Pending') bg-warning 
                                    @elseif($msg->status == 'Delivered') bg-success 
                                    @else bg-secondary 
                                    @endif">
                                    {{ $msg->status }}
                                  </span>
                                </td>
                                <td>
                                  <p class="text-sm mb-0">{{ $msg->created_at->format('d M Y H:i') }}</p>
                                </td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>

                      <!-- Pagination -->
                      @if(isset($messages) && $messages->hasPages())
                      <div class="card-footer d-flex justify-content-center pt-0">
                        <nav aria-label="Page navigation">
                          <ul class="pagination pagination-primary justify-content-center">
                            {{ $messages->links('pagination::bootstrap-4') }}
                          </ul>
                        </nav>
                      </div>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Footer -->
      @include('layouts.adminfooter')
    </div>
  </main>

  <!-- Core JS Files -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  
  <script>
    // Mode toggle functionality
    const manualRadio = document.getElementById('manualMode');
    const importedRadio = document.getElementById('importedMode');
    const selectRadio = document.getElementById('selectMode');
    const manualSection = document.getElementById('manualSection');
    const contactSelectionSection = document.getElementById('contactSelectionSection');
    const sendToImported = document.getElementById('sendToImported');
    const selectedPhoneNumbers = document.getElementById('selectedPhoneNumbers');
    const smsForm = document.getElementById('smsForm');
    const contactSearch = document.getElementById('contactSearch');
    const clearSearch = document.getElementById('clearSearch');
    const selectAllCheckbox = document.getElementById('selectAllCheckbox');
    const contactsContainer = document.getElementById('contactsContainer');
    const selectedCount = document.getElementById('selectedCount');
    const visibleContacts = document.getElementById('visibleContacts');

    // Search functionality
    contactSearch.addEventListener('input', function() {
      const searchTerm = this.value.toLowerCase().trim();
      filterContacts(searchTerm);
    });

    clearSearch.addEventListener('click', function() {
      contactSearch.value = '';
      filterContacts('');
    });

    function filterContacts(searchTerm) {
      const contactItems = document.querySelectorAll('.contact-item');
      let visibleCount = 0;

      contactItems.forEach(item => {
        const name = item.dataset.name || '';
        const phone = item.dataset.phone || '';
        const email = item.dataset.email || '';
        const company = item.dataset.company || '';

        const matches = searchTerm === '' || 
          name.includes(searchTerm) || 
          phone.includes(searchTerm) ||
          email.includes(searchTerm) ||
          company.includes(searchTerm);

        item.style.display = matches ? '' : 'none';
        if (matches) visibleCount++;
      });

      visibleContacts.textContent = visibleCount;
      
      // Update select all checkbox state
      updateSelectAllCheckbox();
    }

    function updateSelectAllCheckbox() {
      const visibleCheckboxes = Array.from(document.querySelectorAll('.contact-item[style*="display"] .contact-checkbox'));
      if (visibleCheckboxes.length === 0) {
        selectAllCheckbox.indeterminate = false;
        selectAllCheckbox.checked = false;
        return;
      }

      const checkedCount = visibleCheckboxes.filter(cb => cb.checked).length;
      
      if (checkedCount === 0) {
        selectAllCheckbox.checked = false;
        selectAllCheckbox.indeterminate = false;
      } else if (checkedCount === visibleCheckboxes.length) {
        selectAllCheckbox.checked = true;
        selectAllCheckbox.indeterminate = false;
      } else {
        selectAllCheckbox.checked = false;
        selectAllCheckbox.indeterminate = true;
      }
    }

    // Select All Checkbox
    selectAllCheckbox.addEventListener('change', function() {
      const visibleCheckboxes = document.querySelectorAll('.contact-item[style*="display"] .contact-checkbox');
      visibleCheckboxes.forEach(checkbox => {
        checkbox.checked = this.checked;
      });
      updateSelectedCount();
    });

    // Update selected contacts count
    function updateSelectedCount() {
      const selected = document.querySelectorAll('.contact-checkbox:checked');
      selectedCount.textContent = selected.length;
      
      // Collect selected phone numbers
      const phones = Array.from(selected).map(cb => cb.dataset.phone);
      selectedPhoneNumbers.value = phones.join(',');
      
      // Update select all checkbox
      updateSelectAllCheckbox();
    }

    // Toggle mode function
    function toggleMode() {
      if (manualRadio.checked) {
        manualSection.style.display = 'block';
        contactSelectionSection.classList.add('d-none');
        sendToImported.value = 0;
      } else if (importedRadio.checked) {
        manualSection.style.display = 'none';
        contactSelectionSection.classList.add('d-none');
        sendToImported.value = 1;
      } else if (selectRadio.checked) {
        manualSection.style.display = 'none';
        contactSelectionSection.classList.remove('d-none');
        sendToImported.value = 2;
        updateSelectedCount();
        contactSearch.value = '';
        filterContacts('');
      }
    }

    // Initialize on page load
    toggleMode();

    // Add event listeners for mode change
    manualRadio.addEventListener('change', toggleMode);
    importedRadio.addEventListener('change', toggleMode);
    selectRadio.addEventListener('change', toggleMode);

    // Contact selection handlers
    document.addEventListener('change', function(e) {
      if (e.target.classList.contains('contact-checkbox')) {
        updateSelectedCount();
      }
    });

    // Select All / Deselect All buttons
    document.getElementById('selectAllBtn').addEventListener('click', () => {
      const allCheckboxes = document.querySelectorAll('.contact-checkbox');
      allCheckboxes.forEach(checkbox => {
        checkbox.checked = true;
      });
      updateSelectedCount();
    });

    document.getElementById('deselectAllBtn').addEventListener('click', () => {
      const allCheckboxes = document.querySelectorAll('.contact-checkbox');
      allCheckboxes.forEach(checkbox => {
        checkbox.checked = false;
      });
      updateSelectedCount();
    });

    // SMS character counter
    const smsMessage = document.getElementById('smsMessage');
    const charCount = document.getElementById('charCount');
    const smsParts = document.getElementById('smsParts');

    smsMessage.addEventListener('input', () => {
      const length = smsMessage.value.length;
      charCount.textContent = length;
      smsParts.textContent = Math.ceil(length / 160);
    });

    // Form submission validation for select mode
    smsForm.addEventListener('submit', function(e) {
      if (selectRadio.checked) {
        const selected = document.querySelectorAll('.contact-checkbox:checked');
        if (selected.length === 0) {
          e.preventDefault();
          alert('Please select at least one contact to send SMS to.');
          return false;
        }
      }
    });

    // Initialize counters
    document.addEventListener('DOMContentLoaded', function() {
      updateSelectedCount();
      visibleContacts.textContent = document.querySelectorAll('.contact-item').length;
    });
  </script>
  
  <!-- Control Center for Material Dashboard -->
  <script src="../assets/js/material-dashboard.min.js?v=3.2.0"></script>
</body>
</html>