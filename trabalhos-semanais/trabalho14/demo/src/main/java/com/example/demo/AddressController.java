package com.example.demo;

import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.ArrayList;
import java.util.Arrays;
import java.util.List;

@RestController
public class AddressController {

    private final List<Address> addresses = new ArrayList<>(
            Arrays.asList(
                    new Address("11111111", "Rua 1", "Bairro 1", "Cidade Amarela"),
                    new Address("22222222", "Rua 2", "Bairro 2", "Cidade Amarela"),
                    new Address("33333333", "Rua 3", "Bairro 1", "Cidade Amarela")
            )
    );

    @GetMapping("/address")
    public List<Address> getAddresses() {
        return this.addresses;
    }

    @GetMapping("/address/{cep}")
    public ResponseEntity<Address> getAddress(@PathVariable String cep) {
        for(Address address : this.addresses)
            if(address.getCep().equals(cep))
                return ResponseEntity.ok(address);

        return ResponseEntity.notFound().build();
    }

    @PostMapping("/address")
    public void addAddress(@RequestBody Address address) {
        this.addresses.add(address);
    }

    @DeleteMapping("/address/{cep}")
    public ResponseEntity<Void> deleteAddress(@PathVariable String cep) {
        Address addressToDelete = this.addresses.stream()
                .filter(address -> address.getCep().equals(cep))
                .findFirst()
                .orElse(null);

        if (addressToDelete != null) {
            this.addresses.remove(addressToDelete);
            return ResponseEntity.noContent().build();
        }

        return ResponseEntity.notFound().build();
    }

    @GetMapping("/hello")
    public String helloWorld() {
        return "Hello World!!";
    }
}
